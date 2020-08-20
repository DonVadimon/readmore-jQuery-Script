try {
    window.$ = window.jQuery = require('jquery');
    $(document).ready(function () {

        let content_ids = [];
        const content_blocks = document.getElementsByClassName('content_block');
        
        for (let i = 0; i < content_blocks.length; i++) {
            if (content_blocks[i].id) {
                content_ids.push(content_blocks[i].id);
            }
        }

        let toggle_ids = [];
        const content_toggles = document.getElementsByClassName('content_toggle');

        for (let i = 0; i < content_toggles.length; i++) {
            if (content_toggles[i].id) {
                toggle_ids.push(content_toggles[i].id);
            }
        }

        for (let i = 0; i < content_ids.length; i++) {
            if ($('#' + content_ids[i]).children().height() > $('#' + content_ids[i]).height()) {   
                $('#' + toggle_ids[i]).click(function(){
                    $('#' + content_ids[i]).toggleClass('hide');
                    $('#' + content_ids[i]).toggleClass('show');
                    if ($('#' + content_ids[i]).hasClass('hide')) {
                        $('#' + toggle_ids[i]).html('Подробнее');
                    } else {
                        $('#' + toggle_ids[i]).html('Скрыть');
                    }
                    return false;
                });
            }else {
                $('#' + toggle_ids[i]).hide();
                $('#' + content_ids[i]).height(function(i, val) {
                    return val + $('.content_toggle').outerHeight();//добавляем высоту ссылки для разворачивания текста
                });
            }
        }
    });
} catch (e) {}


// try {
//     window.$ = window.jQuery = require('jquery');
//     $(document).ready(function () {
//         $('.content_toggle').click(function(){
//             $('.content_block').toggleClass('hide');	
//             if ($('.content_block').hasClass('hide')) {
//                 $('.content_toggle').html('Подробнее');
//             } else {
//                 $('.content_toggle').html('Скрыть');
//             }		
//             return false;
//         });
//     });
// } catch (e) {}
