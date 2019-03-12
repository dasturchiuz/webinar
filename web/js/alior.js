function showCart(res){
    $("#productmodal .modal-body").html(res);
    $("#productmodal").modal();
}
function showProduct(res){
    $("#quikview .modal-body").html(res);
    $("#quikview").modal();
}
var config = {
    decrementButton: "<strong>-</strong>", // button text
    incrementButton: "<strong>+</strong>", // ..
    groupClass: "", // css class of the input-group (sizing with input-group-sm or input-group-lg)
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "2.5em",
    textAlign: "center",
    autoDelay: 500, // ms holding before auto value change
    autoInterval: 100, // speed of auto value change
    boostThreshold: 15, // boost after these steps
    boostMultiplier: 4,
    locale: null // the locale for number rendering; if null, the browsers language is used
}

$(document).on("click", ".itemimg", function(event){
    event.preventDefault();
    $("#carouselExampleControls").carousel($(this).data('id'));

});



$(document).on("click", "#clearcart", function(event){
    event.preventDefault();
    console.log('uchirdi');
    $.ajax({
        url: '/cart/clearcart',
        type:'GET',
        success:function (res){
            location.reload();
            console.log('uchirdi');
        },
        error:function (res){
            alert('Ошибка!');
        },
    });
});

$(document).on("click", ".dell-item", function(event){
    event.preventDefault();
    var id =$(this).data('id');
    console.log(id);
    $.ajax({
        url:'/cart/dellitem',
        data:{'id':id},
        type:'GET',
        success:function (res){
            if(!res) alert('Ошибка!');
            console.log(res);
            showCart(res);
        },
        error:function (res){
            alert('Ошибка!');
        },
    });
});
$(document).on("click", ".dell-itemkorzina", function(event){
    event.preventDefault();
    var id =$(this).data('id');
    console.log(id);
    $.ajax({
        url:'/cart/dellitem',
        data:{'id':id},
        type:'GET',
        success:function (res){
            if(!res) alert('Ошибка!');
            location.reload();
            //console.log(res);
            //showCart(res);
        },
        error:function (res){
            alert('Ошибка!');
        },
    });
});
$(document).on("click", ".add-to-cart", function(event){
    event.preventDefault();
    var id =$(this).data('id');
    var qty =$("#qty").val();
    $.ajax({
        url:'/cart/addtocart',
        data:{'id':id, 'qty':qty},
        type:'GET',
        success:function (res){

            if(!res) alert('Ошибка!');
            var data_server=JSON.parse(res);

            if(data_server.sts==1){
                alert("Tavar qolmadi");
            }else{
                $("#car-count").text(data_server.count);
                showCart(data_server.res);
            }

        },
        error:function (res){
            alert('Ошибка!');
        },
    });
});




$(".quikview").on('click', function (e) {
    e.preventDefault();
    var id =$(this).data('id');
    $.ajax({
        url:'/product/quikview',
        data:{'product_id':id},
        type:'GET',
            success:function (res){
                if(!res) alert('Ошибка!');
                showProduct(res);
            },
            error:function (res){
                alert('Ошибка!');
            },
    });
});

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('da79edcbc293f44f34f4', {
    cluster: 'ap2',
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
});
//
