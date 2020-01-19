<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Folder application/helpers
 */

// all_helper.php
$lang['help_deal'] = "Deal en ligne";
$lang['help_coupon'] = "Coupon";
$lang['help_coupon_full'] = "Coupon de réduction";
$lang['help_bonplan'] = "Bon plan";

$lang['help_buy_online'] = "Acheter en ligne";
$lang['help_print_coupon'] = "Imprimer le coupon";
$lang['help_quotation'] = "Devis en ligne";

$lang['help_target_1'] = "Tout le monde";
$lang['help_target_2'] = "Hommes et Femmes";
$lang['help_target_3'] = "Femmes uniquement";
$lang['help_target_4'] = "Hommes uniquement";
$lang['help_target_5'] = "Enfants uniquement";
$lang['help_target_6'] = "Tout le monde";

$lang['help_validity_1'] = "maximum 90 jours après l'achat (deal en ligne) / impression coupon (coupons à imprimer)";
$lang['help_validity_2'] = "maximum 60 jours après l'achat (deal en ligne) / impression coupon (coupons à imprimer)";
$lang['help_validity_3'] = "maximum 30 jours après l'achat (deal en ligne) / impression coupon (coupons à imprimer)";
$lang['help_validity_4'] = "date spécifique";
$lang['help_validity_5'] = "Tout le temps";
$lang['help_validity_6'] = "Non spécifié";

$lang['help_appointment_1'] = "Sans rendez-vous";
$lang['help_appointment_2'] = "Prise de RDV obligatoire";
$lang['help_appointment_3'] = "Réservation obligatoire";
$lang['help_appointment_4'] = "Non spécifié";

// NOTIFICATIONS
$lang['help_notif_account_created'] = '<h3><i class="fa fa-user"></i> Votre compte a bien été créé !</h3><p>Vous pouvez désormais ajouter des bons plans à vos favoris.</p>';
$lang['help_notif_connected'] = '<h3><i class="fa fa-lock"></i> Vous êtes connecté !</h3>';
$lang['help_notif_logout_complete'] = '<h3><i class="fa fa-unlock"></i> Vous avez été déconnecté !</h3>';
$lang['help_notif_newsletter_bad'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous avez été déconnecté !</h3>';
$lang['help_notif_newsletter_ok'] = '<h3><i class="fa fa-envelope"></i> Vous êtes désormais inscrit à la newsletter !</h3><p>Vous recevrez prochainement les bons plans de '.SITE_NAME.'</p>';
$lang['help_notif_message_sended'] = '<h3><i class="fa fa-envelope"></i> Votre message a été envoyé !</h3><p>Merci pour votre message, nous vous répondrons dès que possible.</p>';
$lang['help_notif_message_sended'] = '<h3><i class="fa fa-envelope"></i> Votre message a été envoyé !</h3><p>Merci pour votre message, nous vous répondrons dès que possible.</p>';
$lang['help_notif_bad_favorite'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous devez créer un compte pour ajouter ce bon plan à vos favoris !</h3><p>La zone de <strong>"favoris"</strong> vous permet de stocker différents bons plans sur votre espace personnel afin de les garder de côté pour plus tard et les retrouver facilement.</p>';
$lang['help_notif_favorite_access_required'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous devez créer un compte pour ajouter des bons plans à vos favoris !</h3><p>La zone de <strong>"favoris"</strong> vous permet de stocker différents bons plans sur votre espace personnel afin de les garder de côté pour plus tard et les retrouver facilement.</p>';
$lang['help_notif_store_exists'] = '<h3><i class="fa fa-exclamation-triangle"></i> Votre boutique existe déjà !</h3><p>L\'addresse email entrée nous indique que votre commerce existe déjà, merci de <a href="' . base_url('store/signin') . '">vous connecter</a> pour ajouter de nouveaux bons plans à votre boutique.</p><p><a href="' . base_url('store/signin') . '" class="btn">Aller à la connexion</a></p>';
$lang['help_notif_bad_store'] = '<h3><i class="fa fa-exclamation-triangle"></i> La boutique n\'existe pas !</h3><p>Il est possible que cette boutique ai été supprimé de '.SITE_NAME.'</p>';
$lang['help_notif_unknown'] = '<h3><i class="fa fa-exclamation-triangle"></i> Erreur inconnue !</h3><p>Une erreur s\'est produite, veuillez nous excuser. Vous pouvez ré-essayer votre dernière action ou nous contacter si le problème persistse.</p>';
$lang['help_notif_review_added'] = '<h3><i class="fa fa-check"></i> Commentaire ajouté !</h3><p>Merci pour votre commentaire. <span class="hidden">Notre équipe va analyser votre appréciation avant publication sur le site.</span></p>';
$lang['help_notif_coupon_connect'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous devez vous connecter !</h3><p>Merci de vous connecter à votre compte en ligne pour accéder à votre coupon. Si vous ne vous souvenez pas de vos identifiants, vérifiez vos emails et votre boite de SPAM ou indésirables afin de retrouver l\'email de '.SITE_NAME.' qui vous indique que votre compte a bien été créé. Si vous n\'avez pas de compte, <a href="' . base_url('users/signup') . '">cliquez ici pour devenir membre</a>.</p>';
$lang['help_notif_access_required'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous devez vous connecter !</h3><p>Merci de vous connecter à votre compte en ligne pour accéder à cette section. Si vous ne vous souvenez pas de vos identifiants, vérifiez vos emails et votre boite de SPAM ou indésirables afin de retrouver l\'email de '.SITE_NAME.' qui vous indique que votre compte a bien été créé. .</p>';
$lang['help_notif_boost_paid'] = '<h3><i class="fa fa-check"></i> Boost validé !</h3><p>Merci pour votre paiement. Votre boost est pris en compte, nous le traiterons au plus vite, vous serez informé par email de sa prise en compte. Surveillez vos statistiques pour voir l\'évolution de vos visites / ventes. Vous pouvez ajouter un autre boost si vous le souhaitez.</p>';
$lang['help_notif_payment_canceled'] = '<h3><i class="fa fa-exclamation-triangle"></i> Un problème durant le paiement ?</h3><p>Le paiement via Paypal est sécurisé, vos informations bancaires sont en sécurité.</p>';
$lang['help_notif_deal_paid'] = '<h3><i class="fa fa-check"></i> Paiement validé !</h3><p>Merci pour votre paiement. Votre bon plan / coupon à imprimer est désormais en attente de validation par notre équipe. Vous serez informé de sa mise en ligne par email.</p>';
$lang['help_notif_print_blocked'] = '<h3><i class="fa fa-exclamation-triangle"></i> Vous devez vous connecter !</h3><p>Afin de pouvoir imprimer les coupons de réduction, vous devez créer un compte '.SITE_NAME.' GRATUIT ou bien <a href="' . base_url('users/signin') . '">vous connecter à votre compte</a> si vous êtes déjà inscrit.</p>';
$lang['help_notif_deal_ended'] = '<h3><i class="fa fa-exclamation-triangle"></i> Bon plan non disponible !</h3><p>Il est possible que ce bon plan ne soit plus disponible, qu\'il ai été supprimé par le commerçant ou qu\'il nécessite une validation de l\'équipe '.SITE_NAME.'.</p>';
$lang['help_notif_action_ok'] = '<h3><i class="fa fa-check"></i> Action validée !</h3><p>Votre dernière action a été effectuée avec succès.</p>';
$lang['help_notif_product_added'] = '<h3><i class="fa fa-check"></i> Bon plan ajouté au panier !</h3><p>Votre bon plan a été ajouté à votre panier. Vous pouvez soit continuer votre recherche de bons plans sur le site, soit finaliser votre commande en cliquant sur "commander".</p>';
$lang['help_notif_phone_ok'] = '<h3><i class="fa fa-check"></i> Nous allons vous appeler !</h3><p>Merci pour votre demande, nous allons vous appeler dans le créneau horaire indiqué.</p>';
$lang['help_notif_quotation_sended'] = '<h3><i class="fa fa-check"></i> Demande de devis envoyée !</h3><p>Merci pour votre demande de devis, le marchand reviendra vers vous par email ou téléphone rapidement.</p>';
$lang['help_notif_error_form'] = '<h3><i class="fa fa-exclamation-triangle"></i> Erreur sur le formulaire !</h3><p>Une erreur s\'est produite durant la validation de votre formulaire. Merci de recommencer.</p>';

// ALL
$lang['start'] = 'Start';
$lang['end'] = 'End';