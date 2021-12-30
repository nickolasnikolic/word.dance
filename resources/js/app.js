/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.dropotron.min.js');
require('./jquery.scrollex.min.js');
require('./jquery.scrolly.min.js');
require('./browser.min.js');
require('./breakpoints.min.js');
require('./util');
require('./main');
$(document).ready(function(){ 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.vote').on('click', function(e){
        var $target = $(e.currentTarget);
        var id = $target.attr('id-of-record');
        var direction = null;
        //if the like button has been clicked

        if($target.hasClass('like')){
            direction = 1;
        }else if($target.hasClass('meh')){
            //else if the meh button has been clicked
            direction = 2;
        }else if($target.hasClass('hate')){
            //else if the hate speech button has been clicked.
            direction = 3;
        }

        //send message
        $.post('/api/like', {
            'mode': direction,
            'record': id
        }, function(result){
            $('a.vote').forEach(function($el){
                $el.prop('disabled', true);
            });
        });

    });
});
