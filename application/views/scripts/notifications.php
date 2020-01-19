<?php if (isset($_GET['notif'])) : ?>
    <?php $notif = getNotif($_GET['notif'], isset($_GET['url']) ? $_GET['url'] : false); ?>
    <?php if ($notif) : ?>
        <main class="main-content">
            <div class="page-container pt-10">
                <div class="container">
                    <div id="notification_head" class='col-md-12 alert alert-<?php echo $notif['class'] ?> mb-0 text-center fade in' style="display: none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $notif['text']; ?>
                    </div>
                </div>
            </div>
        </main>
    <?php endif; ?>
<?php endif; ?>
