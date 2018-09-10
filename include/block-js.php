<script type="text/javascript" src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/vendor/animsition/js/animsition.min.js"></script>
<script type="text/javascript" src="/vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/vendor/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="/vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="/js/slick-custom.js"></script>
<!--<script type="text/javascript" src="/vendor/noui/nouislider.min.js"></script>-->
<script type="text/javascript" src="/vendor/sweetalert/sweetalert.min.js"></script>
<script src="/js/main.js"></script>
<script src="/js/TextChange.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript" src="/vendor/select2/select2.min.js"></script>
<script type="text/javascript" src="/vendor/jquery-zoom/jquery.zoom.js"></script>

<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
</script>



<script type="text/javascript">
    $('.block2-btn-addcart').each(() => {
        let nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', () => {
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<script>
    $('.block2-btn-addcart').click(function () {

        let product_id = $(this).attr("product_id");
        console.log(product_id);

        $.ajax({
            type: "POST",
            url: '/settings/addtocart.php',
            data: "id=" + product_id,
            dataType: "html",
            cache: false,
            success: function () {
                loadCart();
            }
        });
    });

    loadCart();

    function  loadCart() {

        $.ajax({
            type: 'POST',
            url: '/settings/loadcart.php',
            dataType: 'html',
            cache: false,
            success: function (data) {
                if (data == 0) {
                    $('.count > span').html(0);
                } else {
                    $('.header-wrapicon2').html(data);
                }
            }
        });
    }
</script>
<script>
    $('#input-search').bind('textchange', function () {

        let input_search = $('#input-search').val();

        if (input_search.length >= 3) {
            $.ajax({
                type: "POST",
                url: "/settings/show-search.php",
                data: "text=" + input_search,
                dataType: "html",
                cache: false,
                success: function (data) {
                    if (data > '') {
                        $('#result-search').show().html(data);
                    } else {
                        $('#result-search').hide()
                    }
                }
            });
        } else {
            $('#result-search').hide()
        }
    });
</script>
<script>
    $('.minus').click(function () {
        let minus = $(this).attr('data-minus');
        let price_product = $(this).attr('price');
        let btnClicked = this;

        $.ajax({
            type: "POST",
            url: "/settings/count-minus.php",
            data: "id=" + minus,
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#result" + minus).val(data);
                loadCart();

                let result_total = Number(price_product) * Number(data);

                $(btnClicked).closest(".table-row").find('#total_product').html("$" + (result_total));

                final_price();
            }
        });
    });

    $('.plus').click(function () {
        let plus = $(this).attr('data-plus');
        let price_product = $(this).attr('price');
        let btnClicked = this;

        $.ajax({
            type: "POST",
            url: "/settings/count-plus.php",
            data: "id=" + plus,
            dataType: "html",
            cache: false,
            success: function (data) {
                $("#result" + plus).val(data);
                loadCart();

                result_total = Number(price_product) * Number(data);

                $(btnClicked).closest(".table-row").find('#total_product').html("$" + (result_total));

                final_price();
            }
        });
    });

    function final_price() {
        $.ajax({
            type: "POST",
            url: "/settings/final_price.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $('.final-price').html("$" + (data));
            }
        })
    }
</script>
<script>
    $('.logout').click(function () {
        console.log('ok');
        $.ajax({
            type: 'POST',
            url: '/reg/logout.php',
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data == 'logout') {
                    location.reload();
                }
            }
        })
    })
</script>

<script>

    $('.pic').hover(function() {
        let _this = this,
            images = _this.getAttribute('data').split(','),
            counter = 0;
        this.setAttribute('data-src', this.src);

        if(counter > images.length) {
            counter = 0;
        }
        if (images[counter] != undefined) {
            _this.src=images[counter];
        } else {
            _this.src=_this.getAttribute('data-src');
        }

    }, function() {
        this.src = this.getAttribute('data-src');
    });

</script>