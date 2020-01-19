<?php 
/**
 * FILE NOT USED, ONLY TO KNOW EVERY EVENTS ON FACEBOOK PIXELS
 */
?>
<!--
L’évènement search doit être placé sur une page de résultats de recherche pour savoir quand les personnes effectuent une recherche. Ajoutez un paramètre de chaîne de recherche pour suivre des termes de recherche particuliers et optimiser vos publicités pour ces derniers.
-->
<script>
    fbq('track', 'Search', {
        search_string: 'leather sandals'
    });
</script>
<!--
L’évènement view content doit être placé sur une page de détails de contenu ou de produit pour savoir quand les personnes la consultent. Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Afficher le contenu.
-->
<script>
fbq('track', 'ViewContent', {
value: 3.50,
currency: 'USD'
});
</script>
<!--
L’évènement add to wishlist doit être déclenché lorsqu’une personne ajoute ou enregistre un article dans une liste de souhaits sur votre site web. Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Ajouter à la liste de souhaits.
-->
<script>
fbq('track', 'AddToWishlist', {
value: 247.35,
currency: 'USD'
});
</script>
<!--
L’évènement add to cart doit être déclenché lorsqu’une personne ajoute un article à un panier sur votre site web. Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Ajouter au panier.
-->
<script>
fbq('track', 'AddToCart', {
value: 3.50,
currency: 'USD'
});
</script>
<!--
L’évènement initiate checkout doit être déclenché lorsqu’une personne exécute le processus de paiement sur votre site web.
-->
<script>
fbq('track', 'InitiateCheckout');
</script>
<!--
L’évènement add payment info doit être déclenché lorsqu’une personne ajoute des informations de paiement à un compte ou lors d’un processus de paiement.
-->      
<script>
fbq('track', 'AddPaymentInfo');
</script>
<!--
L’évènement purchase doit être placé sur une page de confirmation de commande ou déclenché à partir d’un bouton d’exécution de commande, pour indiquer qu’une personne a acheté un produit. Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Acheter.
-->
<script>
fbq('track', 'Purchase', {
value: 247.35,
currency: 'USD'
});
</script>
<!--
L’évènement lead doit être placé sur la page de confirmation d’un formulaire ou déclenché par un bouton d’envoi lorsqu’un formulaire de prospect est rempli (par exemple : lorsqu’une personne s’abonne à une newsletter). Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Prospect.
-->
<script>
fbq('track', 'Lead', {
value: 10.00,
currency: 'USD'
});
</script>
<!--
L’évènement complete registration doit être placé sur la page de confirmation d’un formulaire d’inscription ou déclenché par un bouton d’envoi lorsqu’un formulaire d’inscription est rempli (par exemple : lorsqu’une personne s’abonne à un service). Ajoutez des paramètres pour la valeur (montant par affichage de contenu) et la devise de conversion afin de mesurer la valeur des conversions Inscription terminée.
-->
<script>
fbq('track', 'CompleteRegistration', {
value: 25.00,
currency: 'USD'
});
</script>
<!--
Vous pouvez tirer partir des actions sur le site web qui sont importantes pour votre entreprise et qui ne figurent pas parmi les évènements standard de Facebook en les envoyant en tant qu’évènements personnalisés. Vous devez également définir ces évènements comme conversion personnalisée pour que nous sachions comment les suivre et les optimiser. Modifiez le code ci-dessous afin d’ajouter le nom d’un évènement personnalisé qui compte pour vous, ainsi que les paramètres correspondants.
-->
<script>
fbq('track', '<EVENT_NAME>', {
<parameter_key>: <parameter_value>,
<parameter_key>: '<parameter_value>'
});
</script>


<!--
INITIER UN EVENT
-->
<head>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '817630131724267'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=817630131724267&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</head>
<script>fbq('track', '<EVENT_NAME>');</script>
