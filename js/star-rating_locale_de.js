/*!
 * Star Rating German Translations
 *
 * This file must be loaded after 'star-rating.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-star-rating
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";
    $.fn.ratingLocales['de'] = {
        defaultCaption: '{rating} Estrellas',
        starCaptions: {
            0.5: 'Media Estrella',
            1: 'Una Estrella',
            1.5: 'Uno Punto Cinco Estrellas',
            2: 'Dos Estrellas',
            2.5: 'Dos Punto Cinco Estrellas',
            3: 'Tres estrellas',
            3.5: 'Tres Punto Cinco Estrellas',
            4: 'Cuatro Estrellas',
            4.5: 'Cuatro Punto Cinco Estrellas',
            5: 'Cinco Estrellas'
        },
        clearButtonTitle: 'Comenzar de nuevo',
        clearCaption: 'Sin calificar'
    };
})(window.jQuery);
