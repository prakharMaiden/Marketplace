<?php
include_once("./../../config/config.php");


$text_search = "";
$queryCondition = "";
if(!empty($_POST["text_search"])) {
    $text_search = $_POST["text_search"];
    $wordsAry = explode(" ", $text_search);
    $wordsCount = count($wordsAry);
    $queryCondition = " WHERE ";
    for($i=0;$i<$wordsCount;$i++) {
        $queryCondition .= "products.name LIKE '%" . $wordsAry[$i] . "%' OR products.description LIKE '%" . $wordsAry[$i] . "%'";
        if($i!=$wordsCount-1) {
            $queryCondition .= " OR ";
        }
    }
}
$orderby = " ORDER BY id desc";
$sql = "select *,products.name AS prodname, supplie₹ id AS supplier_id, products.description AS prod_description from products LEFT JOIN suppliers ON products.supplier_id =supplie₹ id LEFT JOIN subcategory ON products.subcategory_id =subcategory.id  " . $queryCondition;
$result = mysqli_query($con,$sql);
include("includes/header.php");
?>
<?php
function highlightKeywords($text, $keyword) {
    $wordsAry = explode(" ", $keyword);
    $wordsCount = count($wordsAry);

    for($i=0;$i<$wordsCount;$i++) {
        $highlighted_text = "<span style='font-weight:bold;'>$wordsAry[$i]</span>";
        $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
    }

    return $text;
}
?>
    <style>
        .error, sup{
            color:red;
        }
        .ps-section--shopping .ps-section__header {
            text-align: center;
            padding-bottom: 50px;
        }
        .ps-section--shopping {
            padding: 50px 0 0 0;
        }
        small {
            font-size: 70%;
        }
        .ps-form__billing-info{
            padding: 20px;
        }.ps-form--checkout{
             background: #f1f1f1;
         }
        .form-control {
            outline: none;
            height: 50px;
            font-size: 14px;
            padding: 0 20px;
            border: none;
            height: 50px;
            background-color: #fff;
            border: 1px solid #dddddd;
            border-radius: 0;
            box-shadow: 0 0 rgba(0, 0, 0, 0);
            -webkit-transition: all .4s ease;
            transition: all .4s ease;
            box-shadow: 0 0 0 #000;
        }
        .ps-product--cart-mobile .ps-product__thumbnail {
            max-width: 150px;
        }
    </style>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Search result (<?php echo $_POST["text_search"]; ?>)</li>
        </ul>
    </div>
</div>
    <div class="ps-page--single" id="about-us">
        <div class="ps-checkout ps-section--shopping">
            <div class="container">
                <div class="ps-section__header">
                    <h1>Search result (<?php echo $_POST["text_search"]; ?>)</h1>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-md-12">
<?php
if(mysqli_num_rows($result)>0) {
while($row = mysqli_fetch_assoc($result)) {
    $new_name = $row["name"];
    if(!empty($_POST["text_search"])) {
        $new_name = highlightKeywords($row["name"],$_POST["text_search"]);
    }
    $new_description = $row["description"];
    if(!empty($_POST["text_search"])) {
        $new_description = highlightKeywords($row["description"],$_POST["text_search"]);
    }
    $image = (!empty($row['featured_image'])) ? 'img/seller/products/'.$row['featured_image'] : 'img/noimage.jpg';
    $productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];

    ?>
                            <?php
                            echo "<div class='ps-product--cart-mobile' style=' border: 1px solid #f1f1f1;padding: 20px;margin-bottom: 10px;'>
                                    <div class='ps-product__thumbnail'>
                                   <a href='product-details.php?id=".$row['id']."'>
                                   
                                    <img src='".PUBLIC_PATH.'/'.$image."' class='thumbnail' alt='User Image'>
                                    </a>
                                    </div>
                                    <div class='ps-product__content'>
                                    <a href='product-details.php?id=".$row['id']."'>
                                    ".$productname."</a>
                                        <p>Sold By:<small> ".$row['company_name']."</small><br/><small>₹ ".number_format($row['unit_price'],2)."</small>
                                    </div>
                                </div>";
                            ?><?php }
                            }else{
    echo "";
}
?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>