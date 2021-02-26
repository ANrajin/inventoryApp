<?php
    include_once('../database/constants.php');
    include_once('DBoperation.php');
    include_once('user.php');
    include_once('manage.php');

    //registration part
    if(isset($_POST['username']) && isset($_POST['email'])){
        $user = new User;
        $result = $user->userAcc(
            $_POST['username'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['u_type']
        );
        echo $result;
        exit();
    }

    //login part
    if(isset($_POST['email']) && isset($_POST['pass'])){
        $user = new User;
        $result = $user->Userlogin($_POST['email'], $_POST['pass']);

        if($result){
            echo $result;
            exit();
        }
    }

    //to get category
    if(isset($_POST['getCategory'])){
        $cat = new DBoperation;
        $rows = $cat->getAllrecords('category');

        foreach ($rows as $row) {
            echo "<option value = '".$row["cat_id"]."'>".$row["cat_name"]."</option>";
        }
        exit();
    }

    //to get category
    if(isset($_POST['getBrands'])){
        $brand = new DBoperation;
        $rows = $brand->getAllrecords('brands');

        foreach ($rows as $row) {
            echo "<option value = '".$row["bid"]."'>".$row["brand_name"]."</option>";
        }
        exit();
    }
    
    //add category
    if(isset($_POST['cate']) && isset($_POST['parent'])){
        $par = $_POST['parent'];
        $cat = $_POST['cate'];

        $cate = new DBoperation;
        $result = $cate->addCategory($_POST['parent'], $_POST['cate']);
        echo $result;
        exit();
    }

    //add products
    if(isset($_POST['date']) && isset($_POST['pName'])){
        $date = $_POST['date'];
        $pName = $_POST['pName'];
        $categ = $_POST['categ'];
        $brand1 = $_POST['brand1'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];

        $prod = new DBoperation;
        $result = $prod->addProducts($categ, $brand1, $pName, $price, $qty, $date);
        echo $result;
        exit();
    }


    //add brands
    if(isset($_POST['brand'])){
        $brand = $_POST['brand'];

        $brn = new DBoperation;
        $result = $brn->addBrand($brand);
        echo $result;
        exit();
    }


    //manage category
    if(isset($_POST["mngCategory"])){
        $m = new Manage;
        $result = $m -> mngRecord("category", $_POST["pageNo"]);
        $rows = $result["rows"];
        $pagination = $result["pagination"];

        if(count($rows) > 0){
            $i = (($_POST["pageNo"] - 1) * 3) + 1;
            foreach ($rows as $row) {
                ?>

                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo $row['root']?></td>
                    <td><a href="" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <button eid = "<?php echo $row['cat_id'];?>" class="btn btn-sm btn-primary edit_ct" data-toggle="modal" data-target="#category">Edit</button>
                        <button did = "<?php echo $row['cat_id'];?>" class="btn btn-sm btn-danger del_ct">Delete</button>
                    </td>
                </tr>

                <?php
                $i++;
            }

            ?>
            <tr><td colspan="5"><?php echo $pagination;?></td></tr>
            <?php 
            exit();
        }
    }


    //manage brands
    if(isset($_POST["mngBrands"])){
        $m = new Manage;
        $result = $m -> mngRecord("brands", $_POST["pageNo"]);
        $rows = $result["rows"];
        $pagination = $result["pagination"];

        if(count($rows) > 0){
            $i = (($_POST["pageNo"] - 1) * 3) + 1;
            foreach ($rows as $row) {
                ?>

                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['brand_name'];?></td>
                    <td><a href="" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <button eid = "<?php echo $row['bid'];?>" class="btn btn-sm btn-primary edit_brand" data-toggle="modal" data-target="#brand">Edit</button>
                        <button did = "<?php echo $row['bid'];?>" class="btn btn-sm btn-danger del_brand">Delete</button>
                    </td>
                </tr>

                <?php
                $i++;
            }

            ?>
            <tr><td colspan="5"><?php echo $pagination;?></td></tr>
            <?php 
            exit();
        }
    }


    //manage brands
    if(isset($_POST["mngProduct"])){
        $m = new Manage;
        $result = $m -> mngRecord("products", $_POST["pageNo"]);
        $rows = $result["rows"];
        $pagination = $result["pagination"];

        if(count($rows) > 0){
            $i = (($_POST["pageNo"] - 1) * 3) + 1;
            foreach ($rows as $row) {
                ?>

                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php echo $row['cat_name'];?></td>
                    <td><?php echo $row['brand_name'];?></td>
                    <td><?php echo $row['product_price'];?></td>
                    <td><?php echo $row['product_stock'];?></td>
                    <td><?php echo $row['added_date'];?></td>
                    <td><a href="" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <button eid = "<?php echo $row['pid'];?>" class="btn btn-sm btn-primary edit_prod" data-toggle="modal" data-target="#product_edit">Edit</button>
                        <button did = "<?php echo $row['pid'];?>" class="btn btn-sm btn-danger del_prod">Delete</button>
                    </td>
                </tr>

                <?php
                $i++;
            }

            ?>
            <tr><td colspan="5"><?php echo $pagination;?></td></tr>
            <?php 
            exit();
        }
    }


    //Delete Brand
    if(isset($_POST['deleteBrand'])){
        $obj = new Manage;
        $result = $obj->deleteData("brands", "bid", $_POST['id']);
        echo $result;
    }

    //Delete Product
    if(isset($_POST['deleteProduct'])){
        $obj = new Manage;
        $result = $obj->deleteData("products", "pid", $_POST['id']);
        echo $result;
    }


    //Delete category
    if(isset($_POST['deleteCategory'])){
        $obj = new Manage;
        $result = $obj->deleteData("category", "cat_id", $_POST['id']);
        echo $result;
    }


    //get single record catgory
    if(isset($_POST['getReord'])){
        $obj = new Manage;
        $result = $obj->getRecord("category", "cat_id", $_POST["id"]);
        echo json_encode($result);
        exit();
    }


    //get single record brand
    if(isset($_POST['getRecord'])){
        $obj = new Manage;
        $result = $obj->getRecord("brands", "bid", $_POST["id"]);
        echo json_encode($result);
        exit();
    }

    
    //get single record product
    if(isset($_POST['getP_Record'])){
        $obj = new Manage;
        $result = $obj->getRecord("products", "pid", $_POST["id"]);
        echo json_encode($result);
        exit();
    }

    //update category
    if(isset($_POST["cat_name_upd"])){
        $obj = new Manage;

        $id = $_POST["cid"];
        $cName = $_POST["cat_name_upd"];
        $pCat = $_POST["upd_parent"];

        $where = [
            "cat_id" => $id
        ];

        $data = [
            "parent_cat" => $pCat,
            "cat_name" => $cName
        ];

        $result = $obj->update("category", $where, $data);
        echo $result;
    }

    //update Brand
    if(isset($_POST["update_brand"])){
        $obj = new Manage;

        $id = $_POST["bid"];
        $brand = $_POST["update_brand"];

        $where = [
            "bid" => $id
        ];

        $data = [
            "brand_name" => $brand
        ];

        $result = $obj->update("brands", $where, $data);
        echo $result;
    }

    //update Products
    if(isset($_POST["pid"]) && isset($_POST["up_pName"])){
        $obj = new Manage;

        $where = [
            "pid" => $_POST["pid"]
        ];

        $data = [
            "product_name" => $_POST["up_pName"],
            "cat_id" => $_POST["up_cid"],
            "bid" => $_POST["up_bid"],
            "product_price" => $_POST["up_price"],
            "product_stock" => $_POST["up_qty"]
        ];

        $result = $obj->update("products", $where, $data);
        echo $result;
    }


    //Add new order item
    if(isset($_POST["getNewOrderItem"])){
        $obj = new DBoperation;
        $rows = $obj->getAllrecords("products");
        ?>
                                <tr>
                                    <td class="px-2"><b class="number">1</b></td>
                                    <td>
                                        <input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name pro_name" value="">

                                        <select class="form-control form-control-sm pid" required>
                                            <option>Select Product</option>
                                            <?php
                                                foreach ($rows as $row) {
                                                    ?>
                                                        <option value="<?php echo $row['pid']?>"><?php echo $row['product_name']?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="tQty[]" readonly class="form-control form-control-sm tqty">
                                    </td>
                                    <td>
                                        <input type="text" name="qty[]" class="form-control form-control-sm qty" required>
                                    </td>
                                    <td>
                                        <input type="text" name="price[]" class="form-control form-control-sm price" readonly>
                                    </td>
                                    <td class="px-4">
                                        BDT. <span class="amt"> 0 </span>
                                    </td>
                                </tr>
        <?php
        exit();
    }


    //get price and qty of one item
    if(isset($_POST["getPriceQty"])){
        $obj = new Manage;
        $result = $obj -> getRecord("products", "pid", $_POST["id"]);
        echo json_encode($result);
        exit();
    }


    //order processing
    if(isset($_POST["date"]) && isset($_POST["cName"])){
        
        $date = $_POST["date"];
        $cName = $_POST["cName"];
        $sub = $_POST["sub"];
        $tax = $_POST["tax"];
        $dis =$_POST["dis"];
        $net = $_POST["net"];
        $paid = $_POST["paid"];
        $due = $_POST["due"];
        $pMethod = $_POST["pm"];

        //array
        $pName = $_POST["pro_name"];
        $tqty = $_POST["tQty"];
        $qty = $_POST["qty"];
        $price = $_POST["price"];

        $obj = new Manage;
        $result = $obj->insertOrders($cName,$date,$sub,$tax,$dis,$net,$paid,$due,$pMethod, $pName, $price, $qty, $tqty);
        echo $result;
    }
?>
