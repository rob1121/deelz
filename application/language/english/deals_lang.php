<?php
/**
 * Lang file folder view/deals
 */
$ci = get_instance();
// partial/add_rating.php
$lang['your_rating'] = 'Your rating :';
$lang['your_rating_text'] = "Leave your appreciation (50 characters minimum)";

// add.php
$lang['connected_line_1'] = "Add new offer to your shop !";
$lang['connected_line_2'] = "The more offers you have available online, the more visitors you get. Do not hesitate to present a maximum of your products / services on ".SITE_NAME;
$lang['tooltip_add_online'] = "The user buys directly online. The best solution to develop your business, the most engaging solution in a purchasing act for the Internet user.";
$lang['tooltip_add_coupon'] = "The surfer prints your coupon before going to your shop to use it. He does not pay anything online. Payment is made in your shop.";
$lang['tooltip_add_other'] = "No promotion is displayed, this is your public price for a service or product. Tip: Create an \"online deal\" to attract the user, then create \"other good deals\".";
$lang['tooltip_add_online_l1'] = "An online deal";
$lang['tooltip_add_online_l2'] = "direct purchase";
$lang['tooltip_add_coupon_l1'] = "A paper coupon";
$lang['tooltip_add_coupon_l2'] = "to print";
$lang['tooltip_add_other_l1'] = "Other good deal";
$lang['tooltip_add_other_l2'] = "Online quotation";

$lang['line_1'] = "Are you a professional ?";
$lang['line_2'] = "Attract customers, get to know your business locally, thanks to the Internet !";
$lang['button_t'] = "<i class='fa fa-rocket'></i> Create your online shop";
$lang['button_l'] = base_url('deals/add_pro');
$lang['line_3'] = "Become a member <strong>Simply and for free</strong>";

$lang['call_back'] = "Recall request ?";
$lang['call_back_time'] = "Time slot";
$lang['your_company'] = "Your company";
$lang['ask_callback'] = "Ask recall";

$lang['already_pro'] = "Already in the network ? Please login !";

// add_coupon.php
$lang['add_coupon_l1'] = "Create an online discount coupon";
$lang['add_coupon_l2'] = "Publish a voucher to print. The payment of the purchase is made directly to the merchant (in your shop) by deducting the amount of the printed coupon. <br />
                         Customers wishing to take advantage of the offer, print their paper coupon before going to your business. <br />
                         You can offer for the same offer: the online deal and the paper coupon. <br />
                         Coupons not cumulable, one coupon per person.";

// add_online.php
$lang['add_online_l1'] = "Create an online deal";
$lang['add_online_l2'] = "The user buys your deal directly online and receives his voucher / discount coupon by email and then goes to your business. <br /> ".SITE_NAME." will return the amount associated with the sale of the coupon by bank transfer (after deduction of the ".SITE_NAME." commission, calculated when creating your deal).";

// add_other.php
$lang['add_other_l1'] = "Create an simple offer";
$lang['add_other_l2'] = "Add FREE any good plan that does not need to be purchased online or have a coupon. <br />
                         You can, for example, promote an event, highlight your restaurant's favorite dish, describe the service your company offers, etc. <br />
                         These good plans show a \"public price\" to the Net surfers, but no reduction. <br /> On this type of offer you can receive <strong>online quotations requests</strong> from users.";

// add_pro.php
$lang['add_pro_l1'] = "Create your online store on ".SITE_NAME;
$lang['add_pro_l2'] = "You want to promote your business on the Web with professional and intuitive tools? <br />
                         Enter the network by creating <strong> easily and free </ strong> your \"shop page\". <br />
                         Photos, infos, deals and other great deals, user reviews, boosts on social networks ... A simple and effective way to give even more visibility to your activity on the Internet.";

// add_process
$lang['category_choice'] = "Category selection";
$lang['subsactegory_choice'] = "And subcategory";
$lang['tooltip_category_choice_l1'] = "Choose the category of your";
$lang['tooltip_category_choice_l2'] = ". If no category matches, please contact us.";
$lang['tooltip_subsactegory_choice_l1'] = "Choose the subcategory of your ";
$lang['tooltip_subsactegory_choice_l2'] = ". If no subcategory matches, please contact us.";
$lang['error_global'] = "An error has occurred, please try again.";
$lang['change_category'] = "Change category";
$lang['deal_creation'] = "Creation of";
$lang['choose_cover'] = "Choose cover photo";
$lang['choose_cover_l1'] = "You must choose a cover photo to represent your ";
$lang['choose_cover_l2'] = ". You can add your own photos IN ADDITION to the cover photo, but MUST select a cover image provided by ".SITE_NAME." to represent your offer. We will analyze your ad, and if we believe that one of your uploaded photos can be used as a cover photo, we will highlight it. If no cover photo matches, choose one at random, we will take care of finding another representative to best your offer.";
$lang['add_pics'] = "Add my pics";

$lang['add_p_title_l1'] = "Title of";
$lang['add_p_title_l2'] = "(Up to 25 characters)";
$lang['add_p_title_input'] = "Enter here the title of your";
$lang['add_p_title_error'] = "The title must contain a minimum of 5 characters and a maximum of 25 characters.";

$lang['add_p_desc_l1'] = "Quick description of";
$lang['add_p_desc_l2'] = "(Up to 85 characters)";
$lang['add_p_desc_input'] = "Enter a short description of your";
$lang['add_p_desc_error'] = "The introductory text must contain a minimum of 5 characters and a maximum of 85 characters.";

$lang['add_p_date1_l1'] = "Start date of the";
$lang['add_p_date1_l2'] = "(publication)";
$lang['add_p_date1_input'] = "Choose start date";
$lang['add_p_date1_error'] = "You must enter a start date for your";

$lang['add_p_date2_l1'] = "End date of the";
$lang['add_p_date2_l2'] = "(publication)";
$lang['add_p_date2_input'] = "Choose end date";
$lang['add_p_date2_error'] = "You must fill in an end date for your";

$lang['add_p_info_tooltip'] = "You can advertise a price, a \"free\" offer or an offer 'on estimate'.";
$lang['add_p_info_title'] = "Pricing Type";
$lang['add_p_info_fixed_price'] = "A fixed price";

$lang['add_p_online_quotation'] = "<strong>Online quote option ?</strong> (Pay option)";

$lang['add_p_price_tooltip'] = "This is the current price of your product, which you currently do NOT HAVE PROMOTION.";
$lang['add_p_price_title_l1'] = "Price ".$ci->config->item('including_taxe');
$lang['add_p_price_title_l2'] = "of my offer";
$lang['add_p_price_title_l2_2'] = "public";
$lang['add_p_price_input_l1'] = "Enter your price";
$lang['add_p_price_input_l2'] = "/ tarif";
$lang['add_p_price_input_l2_2'] = "initial";
$lang['add_p_price_error_l1'] = "You must fill in the base price of your ";
$lang['add_p_price_error_l2'] = "(Number, no comma but points instead).";

// Edit Taxe information
$lang['add_p_taxe_tooltip'] = "This is the amount of VAT your company applies for the sale of this product / service.";
$lang['add_p_taxe_title'] = "VAT";
// Title taxe 1
$lang['add_p_taxe_opt1'] = "8,5%";
// Coef multi taxe 1
$lang['add_p_taxe_opt1_coef'] = "0.085";
// Title taxe 2
$lang['add_p_taxe_opt2'] = "2,1%";
// Coef multi taxe 1
$lang['add_p_taxe_opt2_coef'] = "0.021";
// Title taxe 3
$lang['add_p_taxe_opt3'] = "No VAT";
// Coef multi taxe 1
$lang['add_p_taxe_opt3_coef'] = "1";

$lang['add_p_pricepromo_tooltip'] = "This is the PROMO price you offer on ".SITE_NAME." to our Internet users. You can either fill in this field or the next 2, the calculations are automatic.";
$lang['add_p_pricepromo_title'] = "Price ".$ci->config->item('including_taxe')." after promo on ".SITE_NAME;
$lang['add_p_pricepromo_input'] = "Enter the price after promotion";
$lang['add_p_pricepromo_error_l1'] = "You must fill in the amount of your";
$lang['add_p_pricepromo_error_l2'] = "after promotion  (Number, no comma but instead points), or enter one of the two fields below for an automatic calculation of the final amount.";
$lang['add_p_pricepromo_info'] = "This is the amount to be deducted from your base price to arrive at the PROMO price displayed on ".SITE_NAME." to our users.";

$lang['add_p_promoamount_tooltip'] = "Amount of promotion";
$lang['add_p_promoamount_input'] = "OR enter the promotion amount";
$lang['add_p_promoamount_error'] = "You have to fill in the amount of the promotion (number, no comma but instead points).";

$lang['add_p_promop_tooltip'] = "This is the percentage of discount displayed on ".SITE_NAME." in relation to your base price.";
$lang['add_p_promop_title'] = "Percentage of promotion";
$lang['add_p_promop_input'] = "OR enter the percentage reduction";
$lang['add_p_promop_error'] = "You must enter the percentage reduction (number, no comma but instead points please).";

$lang['add_p_salecalc_l1'] = "You will receive by sale :";
$lang['add_p_salecalc_l2'] = "This amount is the amount we return to you after the ".SITE_NAME." commission, for online deals you only pay when you sell. If no sale is made on the site, publishing the good plan will cost you nothing.";

$lang['add_p_coupon_l1'] = "I want to display on ".SITE_NAME." :";
$lang['add_p_coupon_l2'] = "This is the number of times your coupon will be available for printing for our users. A user who prints a coupon is a \"qualified and committed\" user.
                                 This means that the user path of ".SITE_NAME." causes him to be certain that he is interested in your promotion before displaying the coupon to print. A user who has clicked more than once on \"print\" will only be counted once in your account.";

$lang['add_p_quotation_l1'] = "The publication of your offer is:";
$lang['add_p_quotation_free'] = "FREE";
$lang['add_p_quotation_l2'] = "How many quotes would you like to receive ?";
$lang['add_p_quotation_l3'] = "When you choose the \"online quotation\" option, this allows users to make quotes directly to you via the page of your offer (thanks to an engaging popup for the user).
                                 Here you choose to \"credit your account\" with a number of quotes that you want to receive. If you choose \"10 quotes\", you can receive up to 10 quotes from users directly by email.
                                 If and when the 10 quotes have been requested by the users, the button \"Quotation request\" will disappear from the page of your offer. But you can \"reload your account\" afterwards to receive new requests.
                                 <br />
                                 This option saves you time in your work, you will receive all the contact details of the surfer as well as his request directly by email. ";

$lang['add_p_public_tooltip'] = "This is the type of audience involved in your offer.";
$lang['add_p_public_opt1'] = "Audience";
$lang['add_p_public_opt2'] = "For all";
$lang['add_p_public_opt3'] = "Men and women";
$lang['add_p_public_opt4'] = "Women only";
$lang['add_p_public_opt5'] = "Men only";
$lang['add_p_public_opt6'] = "Children only";

$lang['add_p_use_tooltip'] = "This is the time given to the user after buying his / her voucher online / printing his coupon to use it in your business.";
$lang['add_p_use_opt1'] = "Validity of the offer";
$lang['add_p_use_opt2'] = "90 days after purchase";
$lang['add_p_use_opt3'] = "60 days after purchase";
$lang['add_p_use_opt4'] = "30 days after purchase";
$lang['add_p_use_opt5'] = "A specific date (event for example)";

$lang['add_p_validity_tooltip'] = "This is the validity date of your offer. Is it valid all the time ? Or for a specific date (event for example) ?";
$lang['add_p_validity_opt1'] = "Validity of the offer";
$lang['add_p_validity_opt2'] = "All the time";
$lang['add_p_validity_opt3'] = "A specific date (event for example)";

$lang['add_p_validitydate_title'] = "Date of validity";
$lang['add_p_validitydate_input'] = "Choose validity date";
$lang['add_p_validitydate_error'] = "You must fill in a validity date for your";

$lang['add_p_rdv_tooltip'] = "This is to inform the user if an appointment / booking is required.";
$lang['add_p_rdv_title'] = "Making appointments ?";
$lang['add_p_rdv_opt1'] = "Without an appointment";
$lang['add_p_rdv_opt2'] = "Required appointment";
$lang['add_p_rdv_opt3'] = "Mandatory reservation";

$lang['add_p_couponsnum_tooltip'] = "This is the number of coupon or number of places available for your offer.";
$lang['add_p_couponsnum_title'] = "Number of coupons";

$lang['add_p_description_title_l1'] = "Full description of my";
$lang['add_p_description_title_l2'] = "(50 words minimum)";
$lang['add_p_description_title_l3'] = "The more accurate and organized your description, the more likely you are to attract clients.";
$lang['add_p_description_error_l1'] = "Please fill in the description of your";
$lang['add_p_description_error_l2'] = "(50 words minimum).";

$lang['add_p_next_step'] = "next step";

$lang['add_p_modify'] = "Edit the";

$lang['add_p_companyinfo_title'] = "Information about your business";
$lang['add_p_companyinfo_input'] = "Company Name";
$lang['add_p_companyinfo_error_l1'] = "You must be a company to be able to";
$lang['add_p_companyinfo_title_l2'] = "create a";
$lang['add_p_companyinfo_title_l2_2'] = "publish a";

$lang['add_p_companynum_title'] = "Company number";
$lang['add_p_companynum_error'] = "Please indicate the company registration number. You must be a registered professional to register (see CGV). The specified number is invalid.";

$lang['add_p_names_title'] = "Name / Surname (not displayed online)";
$lang['add_p_names_error'] = "Please indicate your surname and first name (manager or person in charge of the online shop).";

$lang['add_p_address_title'] = "Business address";
$lang['add_p_address_error'] = "Please provide the address of your company.";

$lang['add_p_zipcode_title'] = "Zipcode";
$lang['add_p_zipcode_error'] = "Please provide your postal code (without spaces, numbers only).";

$lang['add_p_city_title'] = "All the cities";
$lang['add_p_city_input'] = "City";
$lang['add_p_city_error'] = "Please provide the name of your city.";

$lang['add_p_phone_title'] = "Phone number";
$lang['add_p_phone_error'] = "Please enter your telephone number (without spaces, numbers only).";

$lang['add_p_email_title'] = "E-mail adress";
$lang['add_p_email_error'] = "Your email address is not valid. Check that there is no space at the beginning or at the end of the field.";

$lang['add_p_infos_title'] = "Additional information ? (optional)";

$lang['add_p_legal_title'] = "I accept the ".SITE_NAME." <a href='".base_url('store/legal')."' target='_blank' class='color-green'>professional Terms and Conditions</a>";

$lang['add_p_checkbox_error'] = "You must check this box.";
$lang['add_p_legal_error'] = "You must accept the general conditions of sale.";

$lang['add_p_add_company'] = "Add my business";
$lang['add_p_valid_deal'] = "Validate my";

// deals.php #### Popups
$lang['add_p_choose_cover_title'] = "Choose the cover photo of the";
$lang['add_p_choose_cover_l1'] = "Selecting your coverage is important, it is your";
$lang['add_p_choose_cover_l2'] = "And will inspire Internet users to consult it. It is representative and not contractual, but must be brought closer to the MAXIMUM of what you offer on your offer. If there are no photos matching your";
$lang['add_p_choose_cover_l3'] = ", <a href='".base_url('home/contact')."'>contact us</a> to ask us the addition of a photo, our team will add the photo for you quickly.";

$lang['add_p_add_pic_title'] = "Add your own photos";

// category_list.php
$lang['categorylist_title_l1'] = "<span class='hidden-xs'>Deals, coupons, offers</span>";
$lang['categorylist_title_l2'] = "<span class='hidden-xs'></span>";
$lang['categorylist_advertise'] = "Advertising";

// deal.php
$lang['deal_illustrate_pic']  = "* Illustrative picture not contractual";
$lang['deal_store_pic']  = "* Provided by management";
$lang['deal_offer_description']  = "Description of the offer";
$lang['deal_offer_public']  = "This offer is intended for";
$lang['deal_offer_condition']  = "Conditions of the offer";
$lang['deal_offer_validity']  = "Validity of the offer";
$lang['deal_offer_rdv']  = "Appointment";
$lang['deal_offer_cancel']  = "Cancellation";
$lang['deal_offer_cancel_conditions']  = "See coupon cancellation policy";
$lang['deal_coupon_title']  = "Coupon";
$lang['deal_coupon_description']  = "The presentation of the ".SITE_NAME." coupon is mandatory to benefit from the offer";
$lang['deal_contacts_title']  = "Information and contacts";
$lang['deal_send_email']  = "Send an email";
$lang['deal_ended']  = "Expired Offer !";
$lang['deal_in_favorite']  = "favorites !";
$lang['deal_to_favorite']  = "Add to favorites";
$lang['deal_date_l1']  = "Date of the offer";
$lang['deal_date_l2']  = "HURRY UP ! Remaining time :";
$lang['deal_review_title']  = "Write a review <small>about seller</small>";
$lang['deal_store_about']  = "About";
$lang['deal_store_partner']  = "partner";
$lang['deal_store_normal']  = "seller";
$lang['deal_store_contact']  = "Contact the seller";
$lang['deal_store_infos']  = "Additional information ? (optional)";
$lang['deal_store_view']  = "See seller's shop";
$lang['deal_partner_title']  = "proposed by";
// deal.php -- popups
$lang['deal_coupon_print']  = "Would you like to print ?";
$lang['deal_coupon_print_l1']  = "If you are interested in this offer, you can click \"YES\" to print the coupon.";
$lang['deal_coupon_print_l2']  = "You must print the coupon before visiting this merchant to take advantage of the promotion.";

$lang['deal_quotation_title']  = "Ask for an estimate to";
$lang['deal_quotation_l1']  = "Fill out your request for quotation below, the merchant will receive it by email and will contact you or offer a quote directly by email.";
$lang['deal_quotation_l2']  = "You must check the box \"I am not a robot\".";
$lang['deal_quotation_lastname']  = "Your lastname";
$lang['deal_quotation_firstname']  = "Your firstname";
$lang['deal_quotation_address']  = "Your address";
$lang['deal_quotation_zipcode']  = "Zipcode";
$lang['deal_quotation_city']  = "City";
$lang['deal_quotation_phone']  = "Phone number";
$lang['deal_quotation_email']  = "E-mail address";
$lang['deal_quotation_description']  = "Please detail your request here (please be as specific as possible)";
$lang['deal_quotation_validate']  = "Validate my request";

// deal_edit.php
$lang['deal_e_cover'] = "Use as cover ?";
$lang['deal_e_prints_l1'] = "Order more printing coupon ? <small>(you still have <strong>";
$lang['deal_e_prints_l2'] = "printing</strong>)</small>";
$lang['deal_e_prints_l3'] = "This is the number of times your coupon will be available for printing for our users. A user who prints a coupon is a \"qualified and committed\" user.
                                                         This means that the user path of ".SITE_NAME." causes him to be certain that he is interested in your promotion before displaying the coupon to print. A user who has clicked more than once on \"print\" will only be counted once in your account.";
$lang['deal_e_quotations_l1'] = "Receive more quotes? <small>(you still have <strong>";
$lang['deal_e_quotations_l2'] = "quotation</strong>)</small>";
$lang['deal_e_offer_condition'] = "Conditions of the offer";
$lang['deal_e_deal_address'] = "Offer address (optional)";
$lang['deal_e_deal_address_l1'] = "Important: Select the address from the drop-down list that appears when you type, otherwise your map will not be placed on the map. To verify that your address is taken into account, you must see the name of the city below the field.";
$lang['deal_e_deal_address_l2'] = "Address of the offer";
$lang['deal_e_edit_validate'] = "Validate changes";
$lang['deal_e_send_message_to_store'] = "Send a message to the seller";
$lang['deal_e_message_sended'] = "Your message has been sent !";
$lang['deal_e_send_message'] = "Send the message";
$lang['deal_e_store_about'] = "About the merchant";
$lang['deal_e_not_available'] = 'Not available in edit mode !';

// deal_payment.php
$lang['deal_pay_l1'] = "Congratulations, your";
$lang['deal_pay_l2'] = "has been saved !";
$lang['deal_pay_l3'] = "In order to validate your";
$lang['deal_pay_l4'] = "for an online display, you must pay the previously selected options.";
$lang['deal_pay_l5'] = "Pay my";

// deal_saved.php
$lang['deal_saved_l1'] = "Congratulations, your";
$lang['deal_saved_l2'] = "has been saved !";
$lang['deal_saved_l3'] = "Our teams will analyze your request and an email will inform you when your";
$lang['deal_saved_l4'] = "will be online..";
$lang['deal_saved_l5'] = "In the meantime, you can <a href='".base_url('deals/add')."'>add more";
$lang['deal_saved_l6'] = "</a> or <a href='".base_url('store/pro')."'>View and edit your \"shop page\"</a>";
$lang['deal_saved_l7'] = "See you soon.";
$lang['deal_saved_l8'] = "Add another";
$lang['deal_saved_l9'] = "See my shop";

// error_form.php
$lang['error_form_l1'] = "An error has occurred !";
$lang['error_form_l2'] = "An error occurred while sending your form, please try again.";
$lang['error_form_l3'] = "I start again !";

// list_deal.php
$lang['list_deal_l1'] = "<span class='hidden-xs'>Offers</span>";
$lang['list_deal_l2'] = "<span class='hidden-xs'></span>";
$lang['list_deal_l3'] = "No offer in this category at the moment !";

// pro_added.php
$lang['pro_added_l1'] = "Congratulations, your business has been registered on ".SITE_NAME;
$lang['pro_added_l2'] = "You can now add different offers on your \"shop page\" in order to obtain visibility with our Internet users. <br />
                                The more you have offers and the more Internet users will want to come to you!";
$lang['pro_added_l3'] = "See my shop";

// search.php
$lang['search_title'] = "Your search :";
$lang['search_title_l1'] = "PASS LOISIRS 974";
$lang['search_title_l2'] = "All offers";
$lang['search_title_l3'] = "All cities";
$lang['search_not_found'] = "No offer corresponds to your search !";


