
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// API preparation parameter
var url = "http://api.giphy.com/v1/gifs/random?";
var key = "api_key=IYPDcpBBcWsrqpoSs1y2Gg08iexDzchY";

const app = new Vue({
    el: '#app',
        data:
            {
                // To store images in it
                images: [],
            },
        mounted(){
            // Getting the images from the api
            this.gettingImages();
            // Reload images every n seconds
            this.reloadImages();
        },
        methods:
            {
                reloadImages: function ()
                {
                    var app = this;
                    window.setInterval(function(){
                        // Getting images from API
                        app.gettingImages();

                    }, 60000);

                },
                gettingImages: function ()
                {
                    var app = this;
                    // Resetting the images array
                    app.images = [];
                    for (var a = 0; a < 10; a++)
                    {
                        // GET request for API
                        var xhr = $.get(url + key);
                        xhr.done(function(data)
                        {
                            console.log("success got data", data);
                            // Adding the image to images array
                            app.images.push(data.data.image_original_url);
                            // $("#images").load(location.href + " #images");
                        });
                    }
                    console.log("Done getting 10 images");
                }
            }

});
