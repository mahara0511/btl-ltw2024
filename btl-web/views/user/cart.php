<!DOCTYPE html>
<html lang="en">
<head>

    <?php require_once(realpath(__DIR__ . '/../..')."/component/head.php"); ?>
    <title>Shopping</title>
    <style>
        label{
            font-size: large;
            position: relative;
            bottom: 25px;
        }
        input {
            border-radius: 3px;
        }

        input:-webkit-autofill {
            background-color: #586c78;
            width: inherit;
            height: inherit;
        }
        *{
            box-sizing: border-box;
        }
        input{
            padding: 0 5px;

        }
        #clear_pw,#clear_email,#clear_fname,#clear_lname,#clear_rpw{
            opacity: 0;
            float: right;
            position: relative;
            top: -55px;
            transition: opacity 0.2s linear
        }
        .note{
            list-style-type: disc;

        }
        #check1,#check2{
            opacity: 0;
            float: left;
            /*position: relative;
            left: -2rem;*/
            transition: opacity 0.2s linear;
        }
        #icon{
            font-size: 12rem
        }
        .imgList{
            aspect-ratio: 1/1;
            max-width: 200px;
        }
        td{
            padding: 5px 5px;
            vertical-align: bottom;
        }
        a{
            color: black;
            font-weight: bold;
            font-size: 1.25rem;
        }
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity {

            display: flex;
            align-items: baseline;
            justify-content: flex-end;
        }
        .quantity button{
            min-height: 30px;
            min-width: 30px;
            padding: 0;
            border: none;
        }
        .quantity input{
            text-align: center;
            border-bottom: none !important;
        }
        @media (max-width: 900px) {
            #icon {
                font-size: 6rem;
            }
            .imgList{
                aspect-ratio: 1/1;
                max-width: 40vw;
                max-height: 200px;
            }
        }
        @media (max-width: 1200px) {
                #icon {
                    font-size: 8rem;
                }

                .card {

                    padding: 0;
                    margin: 0;
                }

        }
    </style>
</head>
<body>
<?php
require_once(realpath(__DIR__ . '/../..')."/views/layouts/header.php"); ?>
<div class="row">
    <?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "shop";

    $conn = new mysqli($servername, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Failed connection: " . $conn->connect_error);
    };
    ?>
    <div class="col l12 s12" >
        <h5>Your Cart</h5>
        <hr/>

        <div class="table-responsive-sm ">
            <table class="table highlight">
                <thead>
                <tr>
                    <th scope="col" >Product</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $results = $conn->query("SELECT id,quantity FROM cart");
                while($row = $results->fetch_assoc()) {
                    $detail=$conn->query("SELECT * FROM products WHERE id=$row[id]")->fetch_assoc();
                    print ' <tr id="record_'.$row['id'].'">';
                    echo '<td>
    <div class="row">
        <div class="col s12">
            <a href="#">'.$detail["name"].'</a>
        </div>
    </div>
    <div class="row"> 
        <div class="col s6">
             <div class="row">
                  <div class="col s12 ">
                        <img src="'.$detail["image"].'" alt="'.$detail["name"].'"class="imgList">
                  </div>
             </div>
        </div>
        <div class="col s6">
            <div class="row">
            <div class="col s12">
                  <input class="right-align" type="text" style="border-bottom: none" id="price_'.$row["id"].'" value="'.number_format($detail["price"],0,'.',',').' VND" readonly="readonly" >
            </div>
            <div class="col s12 right-align">
                 <input class="right-align" type="text" style="border-bottom: none" name="amount_'.$row["id"].'" id="amount_'.$row["id"].'"  readonly value="'.number_format($row["quantity"]*$detail["price"],0,'.',',').' VND">
            </div>
            </div>
            <div class="row">
                <div class="col m12 s12 l6 right-align offset-l6">
                    <div class="row right-align">
                    <div class="col m6 s12 right-align">
                    <div class="quantity">
                        <button class="" onclick="decreaseQuantity('.$row["id"].')"><i class=" tiny material-icons">remove</i></button>
                        <input type="number" style="width: 30%"  id="quantity_'.$row["id"].'" name="quantity_'.$row["id"].'"   min="1" max="20" value="'.$row["quantity"].'"
            onChange="update('.$row["id"].')" >     
                         <button class=" " onclick="increaseQuantity('.$row["id"].')"><i class=" tiny material-icons">add</i></button>
                    </div>
                    </div>
                    <div class="col m6 s12">
                        <button class="btn btn-danger del red" style="margin-right: 5px" id="'.$row["id"].'" >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</td>';
                    print'</tr>';
                }  ?>
                </tbody>
            </table>
        </div>

        <hr/>
        <div class="row">
            <div class="col s12 m3 offset-m8">
                <div class="row">
                    <div class="col s6 left-align" style="font-weight: bold">Total:</div>
                    <div class="col s6 right-align" id="total" style="font-weight: bold"></div>
                </div>
                <div class="row right-align">
                    <button class="btn btn-primary" type="submit" onclick="location.href='check-out.php'" style="margin: 10px">Check out</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
require_once(realpath(__DIR__ . '/../..')."/views/layouts/footer.php"); ?>
<?php require_once(realpath(__DIR__ . '/../..')."/component/script_config.php"); ?>
<script>
    const collection = document.getElementsByClassName("del");
    for (var i = 0; i < collection.length; i++){
                collection[i].addEventListener('click',function(){
                var del_id= this.id;
                console.log(del_id)
                var ele = document.getElementById('record_'.concat(del_id))
                    console.log('record_'.concat(del_id))
                var str= "action.php?id=";
                str=str.concat(del_id);
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    //document.getElementById("demo").innerHTML = this.responseText;
                    console.log(ele)
                    ele.remove();
                }
                    //console.log(str);
                    xhttp.open("GET", str);
                    xhttp.send();
                    updateTotal();
            })
        }

    function update(iteration){

        // alert(iteration);
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'decimal',
            // These options can be used to round to whole numbers.
            //trailingZeroDisplay: 'stripIfInteger'   // This is probably what most people
                                                    // want. It will only stop printing
                                                    // the fraction when the input
                                                    // amount is a round number (int)
                                                    // already. If that's not what you
                                                    // need, have a look at the options
                                                    // below.
            minimumFractionDigits: 0, // This suffices for whole numbers, but will
            // print 2500.10 as $2,500.1
            maximumFractionDigits: 0, // Causes 2500.99 to be printed as $2,501
            useGrouping: 'always'
        });

        var quantity = document.getElementById('quantity_' + iteration).value;
        // alert('quantity_' + iteration);
        console.log(quantity)
        var price = document.getElementById('price_' + iteration).value;
        console.log(price)
        price=price.replace(",","");
        price=price.replace("VND","")
        console.log(iteration)
        price = parseInt(price);
        quantity = parseInt(quantity);

        var amount= formatter.format(quantity * price) ;

        document.getElementById('amount_' + iteration).value = amount.toString().concat(" VND");
        updateTotal();
    }
    document.addEventListener('DOMContentLoaded',updateTotal())

    function updateTotal(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            //document.getElementById("demo").innerHTML = this.responseText;
            console.log(this.responseText)
            document.getElementById('total').innerHTML=this.responseText;
        }
        //console.log(str);
        xhttp.open("POST", 'cart-proc.php' );
        xhttp.send();
    }

</script>

</body>

</html>