<?php

/**
 * Lang file folder view/mailing
 */
// libraries/Mailing.php > Mail objects
$lang['mail_obj_signup_comingsoon'] = 'Vous pouvez accéder à '.SITE_NAME.' en avant première !';
$lang['mail_obj_signup'] = 'Votre inscription sur '.SITE_NAME;
$lang['mail_obj_signup_pro'] = 'Votre commerce est désormais sur '.SITE_NAME;
$lang['mail_obj_deal_added'] = 'Votre bon plan est en cours d\'analyse';
$lang['mail_obj_deal_published'] = 'Votre bon plan est en ligne !';
$lang['mail_obj_boost_treated'] = 'Votre demande de boost a été traitée !';
$lang['mail_obj_new_sale'] = 'Une nouvelle vente !';
$lang['mail_obj_contact'] = SITE_NAME.' :: Message online';
$lang['mail_obj_contact_store'] = SITE_NAME.' :: Message d\'un membre du site !';
$lang['mail_obj_contact_from_admin'] = SITE_NAME.' :: Message de l\'équipe '.SITE_NAME;
$lang['mail_obj_contact_user'] = SITE_NAME.' :: Message d\'un marchand du site !';
$lang['mail_obj_coupon'] = 'Vous pouvez imprimer votre coupon en ligne';
$lang['mail_obj_renew_password'] = 'Votre nouveau mot de passe d\'accès à '.SITE_NAME;
$lang['mail_obj_boost_irl'] = 'Un PRO demande un boost :';
$lang['mail_obj_admin_notif'] = SITE_NAME.' :';
$lang['mail_obj_quotation_pro'] = SITE_NAME.' : Nouvelle demande de devis';
$lang['mail_obj_quotation_user'] = SITE_NAME.' : Résumé de votre demande de devis';

// view/mailing folder
$lang['mail_admin_notif_l1'] = 'Notification '.SITE_NAME.' :';

$lang['mail_boost_irl_l1'] = 'Une PRO vous demande un boost';

$lang['mail_boost_treated_l1'] = 'Demande de boost traitée !';
$lang['mail_boost_treated_l2'] = "Félicitation, votre demande de boost a été traitée par notre équipe.
                <br /><br />RDV sur votre espace boutique en ligne pour suivre vos statistiques régulièrement afin de visualiser l'impact de votre boost. 
                <br /><br /><strong>Astuce : </strong> Vous pouvez cumuler les boosts pour un même bon plan.
                <br /><br />A bientôt sur ".SITE_NAME.".";

$lang['mail_contact_l1'] = "Message envoyé depuis ".SITE_NAME." :";


$lang['mail_contact_from_admin_l1'] = "Message envoyé par ".SITE_NAME." :";
$lang['mail_contact_from_admin_l2'] = "Afin de répondre à ce message, rendez vous sur votre espace boutique en ligne sur ".SITE_NAME." en <a href='" . base_url('store/signin') . "'>cliquant ici</a>.";


$lang['mail_contact_store_l1'] = "Message envoyé par un client ".SITE_NAME." :";
$lang['mail_contact_store_l2'] = "Afin de répondre à ce message, rendez vous sur votre espace boutique en ligne sur ".SITE_NAME." en <a href='" . base_url('store/signin') . "'>cliquant ici</a>.";


$lang['mail_contact_user_l1'] = "Message envoyé par un marchand :";
$lang['mail_contact_user_l2'] = "Afin de répondre à ce message, rendez vous sur votre espace membre en ligne sur ".SITE_NAME." en <a href='" . base_url('users/signin') . "'>cliquant ici</a>.";


$lang['mail_coupon_l1'] = "Merci pour votre commande !";
$lang['mail_coupon_l2'] = "Vous pouvez désormais accéder à votre coupon en ligne très simplement en vous connectant à votre compte ".SITE_NAME.".";
$lang['mail_coupon_l3'] = "Accédez à votre coupon en cliquant ici :";
$lang['mail_coupon_l4'] = "Accéder à mon coupon";
$lang['mail_coupon_l5'] = "A bientôt sur ".SITE_NAME." !";


$lang['mail_deal_added_l1'] = "Bon plan enregistré !";
$lang['mail_deal_added_l2'] = "Merci pour l'ajout de votre bon plan. Il a été enregistré et sera très rapidement analysé par l'équipe de ".SITE_NAME.".
                <br /><br />Afin de mettre toutes les chances de votre côté pour attirer un maximum d'internautes, l'équipe pourra procéder à certaines modifications au niveau du texte ou dans le choix de l'image de couverture. Si les choix de l'équipe ne vous conviennent pas, nous vous invitons à nous contacter sur contact@".SITE_NAME." pour demander une rectification ou une suppression de votre bon plan.
                <br /><br />Si votre deal est accepté, vous serez informé par email de sa publication.
                <br /><br /><strong>IMPORTANT :</strong> Nous vous rappelons que les textes et les images que vous publiez sur vos annonces sont de votre responsabilité et doivent être votre propriété. S'il s'agit d'un copier coller de texte, ou d'images dont vous ne disposez pas des droits d'auteur, nous vous invitons à modifier votre bon plan en vous rendant dans votre boutique en ligne et en cliquant sur l'image du bon plan. 
                <br /><br />Merci de votre compréhension.
                <br /><br />A bientôt sur ".SITE_NAME.".";


$lang['mail_deal_published_l1'] = "Bon plan en ligne !";
$lang['mail_deal_published_l2'] = "Félicitation, votre bon plan a été accepté par l'équipe de ".SITE_NAME.", il est désormais en ligne.
                <br /><br />Connectez vous régulièrement à votre espace boutique en ligne afin de <strong>suivre vos statistiques</strong>.
                <br /><br />La publication d'un bon plan est la première étape pour avoir une \"image en ligne\" et exister sur ".SITE_NAME.". Pour développer vos ventes et votre clientèle, il est important de pouvoir donner de la visibilité à votre bon plan.
                <br /><br />Pour cela, RDV sur votre espace boutique : cliquez sur <strong>\"booster mon business\"</strong>, l'interface vous expliquera comment toucher un maximum d'internautes près de chez vous avec votre bon plan afin d'augmenter votre clientèle.
                <br /><br />A bientôt sur ".SITE_NAME.".";


$lang['mail_new_sale_l1'] = "Une nouvelle vente pour votre deal en ligne !";
$lang['mail_new_sale_l2'] = "Une nouvelle vente pour votre deal en ligne";
$lang['mail_new_sale_l3'] = "Montant de la vente du coupon";
$lang['mail_new_sale_l4'] = "Accédez à votre espace PRO pour suivre vos ventes";
$lang['mail_new_sale_l5'] = "<strong>ASTUCE : </strong>Pour augmenter vos ventes, augmentez votre visibilité auprès de nos internautes. RDV sur votre espace PRO et cliquez sur <strong>\"Booster mon business\"</strong>.</div>
                <br /><br />
                A bientôt sur ".SITE_NAME." !";


$lang['mail_quotation_pro_l1'] = "Nouvelle demande de devis :";
$lang['mail_quotation_pro_l2'] = "Voici les détail de la demande de devis de l'internaute :";
$lang['mail_quotation_pro_l3'] = "Informations de la demande de devis";
$lang['mail_quotation_pro_l4'] = "<em>Vous pouvez répondre directement via cet email pour répondre à l'internaute ou le contacter par téléphone.</em>";


$lang['mail_quotation_user_l1'] = "Résumé de votre demande de devis :";
$lang['mail_quotation_user_l2'] = "Voici les détail de votre demande au marchand :";
$lang['mail_quotation_user_l3'] = "Informations de la demande de devis";
$lang['mail_quotation_user_l4'] = "<em>Le marchand reviendra vers vous prochainement, par email ou par téléphone afin de faire suite à votre demande de devis.</em>";


$lang['mail_renew_password_l1'] = "Voici vos identifiants de connexion :";
$lang['mail_renew_password_l2'] = "Vous êtes désormais inscrit sur ".SITE_NAME.", le site de bons plans.";
$lang['mail_renew_password_l3'] = "Login";
$lang['mail_renew_password_l4'] = "Mot de passe";
$lang['mail_renew_password_l5'] = "A bientôt sur ".SITE_NAME." !";


$lang['mail_signup_l1'] = "Merci pour votre inscription !";
$lang['mail_signup_l2'] = "Vous êtes désormais inscrit sur ".SITE_NAME.", le site de bons plans.
                <br /><br />
                Votre inscription vous permet d'accéder aux services réservés aux membres de ".SITE_NAME.", d'ajouter des bons plans à vos favoris sur le site, et bien d'autres nouveautés à venir ;)";
$lang['mail_signup_l3'] = "Rappel de vos identifiants :";
$lang['mail_signup_l4'] = "Login";
$lang['mail_signup_l5'] = "Mot de passe";
$lang['mail_signup_l6'] = "A bientôt sur ".SITE_NAME." !";


$lang['mail_signup_comingsoon_l1'] = "Vous pouvez désormais accéder à ".SITE_NAME." !";
$lang['mail_signup_comingsoon_l2'] = "Vous avez désormais accès en avant première au site ".SITE_NAME." !
                <br /><br />
                Votre inscription en tant que professionnel vous permet désormais d'ajouter des bons plans, des deals en ligne ou encore des coupons de réduction pour votre société / activité.
                <br /><br />
                N'hésitez pas à ajouter un maximum de bons plans, plus vous aurez de bons plans en ligne et plus vous pourrez attirer d'internautes dans votre boutique.
                <br /><br />
                La création de votre \"boutique en ligne\" sur ".SITE_NAME." est gratuite est sans engagement.
                <br /><br /><br /><br />
                <strong><u>Code d'accès PRO pour votre prochaine visite :</u></strong>
                <br /><br /><strong>run2017</strong>
                A bientôt sur ".SITE_NAME." !";


$lang['mail_signup_pro_l1'] = "Bienvenue dans le réseau Zot'Commerces !";
$lang['mail_signup_pro_l2'] = "Vous êtes désormais inscrit sur ".SITE_NAME.", le site de bons plans.
                <br /><br />
                Votre inscription vous permet d'accéder aux services réservés aux professionnels de ".SITE_NAME.".
                <br /><br />
                Vous pouvez dès maintenant ajouter des bons plans sur le site très facilement. Pour cela, <a href='".base_url('store/signin')."'>connectez vous à votre page boutique</a>.";
$lang['mail_signup_pro_l3'] = "Rappel de vos identifiants";
$lang['mail_signup_pro_l4'] = "Login";
$lang['mail_signup_pro_l5'] = "Mot de passe";
$lang['mail_signup_pro_l6'] = "A bientôt sur ".SITE_NAME." !";

