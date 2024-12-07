<style>
    .materialert{
        position: relative;
        min-width: 150px;
        padding: 15px;
        /* margin-bottom: 20px;
         margin-top: 15px;*/
        border: 1px solid transparent;
        border-radius: 4px;
        transition: all 0.1s linear;
        webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .materialert .material-icons{
        margin-right: 10px;
    }
    .materialert .close-alert{
        -webkit-appearance: none;
        border: 0;
        cursor: pointer;
        color: inherit;
        background: 0 0;
        font-size: 22px;
        line-height: 1;
        font-weight: bold;
        text-shadow: 0 1px 0 rgba(255, 255, 255, .7);
        filter: alpha(opacity=40);
        margin-bottom: -5px;
        position: absolute;
        top: 16px;
        right: 5px;
    }
    .materialert.error{
        background-color: #c62828;
        color: #fff;
    }
</style>

<div class="materialert error">
    <div class="material-icons">error_outline</div>
    <span><?php echo $message?></span>
    <button type="button" class="close-alert">×</button>
</div>

<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/slick.min.js"></script>
<script src="public/js/nouislider.min.js"></script>
<script src="public/js/jquery.zoom.min.js"></script>
<script src="public/js/sweetalert.min.js"></script>
<script src="public/js/jquery.payform.min.js" charset="utf-8"></script>
<script src="public/js/main.js"></script>
<script src="public/js/actions.js"></script>
<script src="public/js/script.js"></script>

<script>
    $('.materialert .close-alert').click(function (){
        $(this).parent().hide('slow');
        $(this).parent().remove();
    });
   /* document.addEventListener('DOMContentLoaded', function () {
        $('.materialert').hide();
    });*/
</script>