$(document).ready(function() {
  // Configuration
  admin.colorpicker();

  // Medias
  admin.dropzone();

  // Load categories
  admin.loadCategories();
  admin.getCovers();

  // Load tinymce for CMS
  admin.loadTinymce();

  // Change cms select
  $("#cms_page").change(function() {
    page = $("#cms_page").val();
    page = page.split("+");
    admin.loadCmsContent(page[0], page[1]);
  });

  // Update V1.1.0
  // Load company information in modal
  $(".companyDatas").click(function() {
    admin.loadCompanyDatas($(this).attr("company_id"));
  });
  // End Update V1.1.0
});
admin = {
  loadTinymce: function() {
    tinymce.init({
      selector: "#content_cms",
      menubar: true,
      height: "680",
      language: "fr_FR",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools codesample toc"
      ],
      toolbar1:
        "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      toolbar2: "print preview media | forecolor backcolor emoticons ",
      init_instance_callback: function(editor) {
        // Load first element
        page = $("#cms_page option:eq(0)").val();
        page = page.split("+");
        admin.loadCmsContent(page[0], page[1]);
      }
    });
  },
  loadCmsContent: function(controller, method) {
    $.ajax({
      url:
        $("#base_url").val() +
        "ajax/loadCmsContent/" +
        controller +
        "/" +
        method,
      dataType: "json"
    })
      .complete(function(res) {
        if (
          res.responseJSON != undefined &&
          res.responseJSON != "false" &&
          res.responseJSON != false
        ) {
          tinyMCE.activeEditor.setContent(res.responseJSON);
        } else {
          tinyMCE.activeEditor.setContent("<p>Aucun contenu</p>");
        }
      })
      .error(function() {
        // Error
      });
  },
  loadCategories: function() {
    $.ajax({
      url: $("#base_url").val() + "ajax/loadCategories",
      dataType: "json"
    })
      .complete(function(res) {
        if (
          res.responseJSON != undefined &&
          res.responseJSON != "false" &&
          res.responseJSON != false
        ) {
          var categories = res.responseJSON;
          $("#categoriesList").treeview({
            color: "#000000",
            showTags: !0,
            data: categories,
            onNodeSelected: function(event, data) {
              if (data.categories_id !== undefined) {
                $("#edit-subcategory [name=category_id]").val(
                  data.categories_id
                );
                $("#edit-subcategory [name=id]").val(data.id);
                $("#edit-subcategory [name=name]").val(data.name);
                $("#edit-subcategory [name=icon]").val(data.icon);
                $("#edit-subcategory [name=image]").val(data.image);
              } else {
                $("#edit-category [name=id]").val(data.id);
                $("#edit-category [name=name]").val(data.name);
                $("#edit-category [name=icon]").val(data.icon);
                $("#edit-category [name=image]").val(data.image);
              }
              $(".coverToChoose img").css("border", "");
              $('.coverToChoose[image="' + data.image + '"] img').css(
                "border",
                "3px solid lightgreen"
              );
              $(".coverInput").val(data.image);
              $("#edit-category").modal("show");
            }
          });
        } else {
          $("#categoriesList").html(
            '<div class="alert alert-error">Impossible de charger les catégories.</div>'
          );
        }
      })
      .error(function() {
        $("#categoriesList").html(
          '<div class="alert alert-error">Impossible de charger les catégories.</div>'
        );
      });
  },
  getCovers: function() {
    $(".loadingCoversError").hide();
    $(".covers").html("");
    // Ajout des photos de couverture
    $.ajax({
      url: $("#base_url").val() + "ajax/loadImagesCategory",
      dataType: "json"
    })
      .complete(function(res) {
        if (res.responseJSON != undefined && res.responseJSON != "false") {
          for (key in res.responseJSON) {
            $(".covers").append(
              '<div class="col-md-3 mb-5 text-center" ' +
                (ismobile == true ? "" : 'style="height: 125px;"') +
                '><a href="#" class="coverToChoose" image="' +
                res.responseJSON[key] +
                '"><img src="' +
                $("#base_url").val() +
                "assets/images/" +
                res.responseJSON[key] +
                '" ' +
                (ismobile == true ? "" : 'style="max-height: 125px;"') +
                " /></div>"
            );
          }
          $(".covers").append('<div class="clear clearfix">&nbsp;</div>');
          admin.chooseCover();
        } else {
          $(".loadingCoversError").show();
        }
      })
      .error(function() {
        $(".loadingCoversError").show();
      });
  },
  chooseCover: function() {
    $(".coverToChoose").unbind("click");
    $(".coverToChoose").click(function(e) {
      e.preventDefault();
      $(".coverToChoose img").css("border", "");
      $("img", this).css("border", "3px solid lightgreen");
      $(".coverInput").val($(this).attr("image"));
      $("#chooseCover").modal("hide");
    });
  },
  dropzone: function() {
    // Désactive Dropzone onload
    Dropzone.autoDiscover = false;
    // Dropzone
    $("#addPicsCategories").dropzone({
      url: $("#base_url").val() + "ajax/addPicsCategories/",
      addRemoveLinks: true,
      dictRemoveFile: "Supprimer",
      dictCancelUpload: "Annuler",
      dictInvalidFileType: "Fichier non autorisé",
      dictFileTooBig:
        "Cette photo est trop grande. Maximum autorisé : {{maxFilesize}}Mb",
      maxFilesize: 10,
      maxFiles: 50,
      acceptedFiles: "image/*",
      dictDefaultMessage:
        '<h3 class="text-center"><span class="font-lg"><i class="fa fa-photo"></i> .png .jpg .gif <span class="font-xs"></span></span><h3>&nbsp&nbsp<h4 class="display-inline"></h4>',
      dictResponseError: "Erreur durant l'envoi de vos photos",
      complete: function() {
        admin.getCovers();
      },
      removedfile: function(file) {
        // Todo
        $.ajax({
          url: $("#base_url").val() + "ajax/deletePicsCategories/",
          data: { name: file.name },
          dataType: "json",
          method: "post"
        })
          .complete(function(res) {
            if (res.responseJSON != undefined && res.responseJSON != "false") {
              $(file.previewElement).remove();
              admin.getCovers();
            } else {
              // Error
            }
          })
          .error(function() {
            // Error
          });
      },
      init: function() {
        var thisDropzone = this;
        $.getJSON($("#base_url").val() + "ajax/loadAllMedias/", function(data) {
          $.each(data, function(key, value) {
            var mockFile = { name: value.name, size: value.size };
            thisDropzone.options.addedfile.call(thisDropzone, mockFile);
            thisDropzone.options.thumbnail.call(
              thisDropzone,
              mockFile,
              value.url
            );
          });
        });
      }
    });
  },
  colorpicker: function() {
    for (i = 1; i <= 4; i++) {
      $("#color_" + i).ColorPicker({
        color: "#" + $("#color_" + i).val(),
        onShow: function(colpkr) {
          $(colpkr).fadeIn(500);
          return false;
        },
        onHide: function(colpkr) {
          $(colpkr).fadeOut(500);
          return false;
        },
        onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide();
        }
      });
    }
  },
  // Update V1.1.0
  loadCompanyDatas: function(currId) {
    $("#store_company").html($("#store_company_" + currId).val());
    $("#store_name_dealer").html($("#store_name_dealer_" + currId).val());
    $("#store_address").html($("#store_address_" + currId).val());
    $("#store_zipcode").html($("#store_zipcode_" + currId).val());
    $("#store_city").html($("#store_city_" + currId).val());
    $("#store_phone").html($("#store_phone_" + currId).val());
    $("#store_email").html($("#store_email_" + currId).val());
    $("#store_informations").html($("#store_informations_" + currId).val());
    $("#store_bank_company").html($("#store_bank_company_" + currId).val());
    $("#store_bank_name").html($("#store_bank_name_" + currId).val());
    $("#store_bank_address").html($("#store_bank_address_" + currId).val());
    $("#store_bank_iban").html($("#store_bank_iban_" + currId).val());
    $("#store_bank_bic").html($("#store_bank_bic_" + currId).val());
    $("#store_paypal_email").html($("#store_paypal_email_" + currId).val());
  }
  // End Update V1.1.0
};
