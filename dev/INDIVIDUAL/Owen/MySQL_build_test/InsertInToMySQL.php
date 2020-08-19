<?php

    // ::::::::::測試語法::::::::::
    // $json_string = file_get_contents('./Initial_member.json');  
    // $data = json_decode($json_string, true);  
 
    // var_dump($data);

    // foreach($data[0] as $i => $value){
    //     echo "$i : $value <br>";
    // }
    // for($a=0 ; $a<14 ; $a++){
    //     echo $data[$a]['mem_id'], "<br>";
    // }
    // for($a=0 ; $a<14 ; $a++){
    //     echo "insert into member (mem_id,mem_name,mem_acc,mem_psw,mem_mail ) value (".$data[$a]['mem_id'].",".$data[$a]['mem_name'].",".$data[$a]['mem_acc'].",".$data[$a]['mem_psw'].",".$data[$a]['mem_mail'].");<br>";
    //     }

?>

<?php 

// ::::::::::測試連線::::::::::
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
    }
    
// ::::::::::這是achievement成就的建立::::::::::
$json_string = file_get_contents('./Initial_achievement.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::15個成就::::::::::
            for($a=0 ; $a<15 ; $a++){
            $sql = "insert into achievement (achievement_category,achievement_name,achievement_require) value  ('".$data[$a]['achievement_category']."','".$data[$a]['achievement_name']."','".$data[$a]['achievement_require']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}


// ::::::::::這是member會員的建立::::::::::
$json_string = file_get_contents('./Initial_member.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::新建前14位創始帳號::::::::::
            for($a=0 ; $a<14 ; $a++){
            $sql = "insert into member (mem_id,mem_name,mem_acc,mem_psw,mem_mail ) value ('".$data[$a]['mem_id']."','".$data[$a]['mem_name']."','".$data[$a]['mem_acc']."','".$data[$a]['mem_psw']."','".$data[$a]['mem_mail']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }

            // ::::::::::更新前7位超強帳號::::::::::
            $sql = "update member set mem_point = 80000 , total_post = 200 , total_host = 200 , total_join = 500 , mem_point_forumpost = 20000 , mem_point_tourhost = 20000 , mem_point_tourjoin = 20000 , mem_point_game = 20000 where mem_no between 10001 and 10007;";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);


			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
    }
    

// ::::::::::這是administrator管理員的建立::::::::::
$json_string = file_get_contents('./Initial_administrator.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::新建前7位管理員後台帳號::::::::::
            for($a=0 ; $a<7 ; $a++){
            $sql = "insert into administrator (admin_id,admin_name,admin_acc,admin_psw,admin_mail,admin_build) value ('".$data[$a]['admin_id']."','".$data[$a]['admin_name']."','".$data[$a]['admin_acc']."','".$data[$a]['admin_psw']."','".$data[$a]['admin_mail']."',now());";
            echo $sql;
            $affectedRow = $pdo -> exec($sql);
            }

            // ::::::::::新建前7位管理員前台帳號::::::::::
            for($a=0 ; $a<7 ; $a++){
            $sql = "insert into member (mem_id,mem_name,mem_acc,mem_psw,mem_mail,class) value ('".$data[$a]['admin_id']."','".$data[$a]['admin_name']."','".$data[$a]['admin_acc']."','".$data[$a]['admin_psw']."','".$data[$a]['admin_mail']."','1');";
            echo $sql;
            $affectedRow = $pdo -> exec($sql);
            }

			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}


// ::::::::::這是degree難度的建立::::::::::
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::新建4級難度::::::::::
            $sql = "insert into degree (degree_category,degree_describe) value('1', 'easy'),('2','normal'),('3','hard'),('4','expert');";
           echo $sql."<br>";
			$affectedRow = $pdo -> exec($sql);
			
			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}


// ::::::::::這是mountain山的建立::::::::::
$json_string = file_get_contents('./Initial_mountain.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::新建16座山::::::::::
            for($a=0 ; $a<16 ; $a++){
            $sql = "insert into mountain (degree_category,mountain_name,mountain_latitude,mountain_longitude,mountain_area,mountain_image ) value  ('".$data[$a]['degree_category']."','".$data[$a]['mountain_name']."','".$data[$a]['mountain_latitude']."','".$data[$a]['mountain_longitude']."','".$data[$a]['mountain_area']."','".$data[$a]['mountain_image']."');";
            echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}



// ::::::::::這是product商品的建立::::::::::
$json_string = file_get_contents('./Initial_product.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // :::::::::: 5類別*4難度::::::::::
            for($a=0 ; $a<20 ; $a++){
            $sql = "insert into product (degree_category,product_category,product_name,product_price,product_description) value  ('".$data[$a]['degree_category']."','".$data[$a]['product_category']."','".$data[$a]['product_name']."','".$data[$a]['product_price']."','".$data[$a]['product_description']."');";
            echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}



// ::::::::::這是tour揪團的建立::::::::::
$json_string = file_get_contents('./Initial_tour.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::16個團::::::::::
            for($a=0 ; $a<16 ; $a++){
            $sql = "insert into tour (tour_hoster,tour_mountain,tour_end,tour_activitystart,tour_activityend,tour_min_number,tour_max_number,tour_title,tour_notice,tour_innertext,tour_equip_1,tour_equip_2,tour_equip_3,tour_equip_4,tour_equip_5) value  ('".$data[$a]['tour_hoster']."','".$data[$a]['tour_mountain']."','".$data[$a]['tour_end']."','".$data[$a]['tour_activitystart']."','".$data[$a]['tour_activityend']."','".$data[$a]['tour_min_number']."','".$data[$a]['tour_max_number']."','".$data[$a]['tour_title']."','".$data[$a]['tour_notice']."','".$data[$a]['tour_innertext']."','".$data[$a]['tour_equip_1']."','".$data[$a]['tour_equip_2']."','".$data[$a]['tour_equip_3']."','".$data[$a]['tour_equip_4']."','".$data[$a]['tour_equip_5']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}




// ::::::::::這是forum_post討論區發文的建立::::::::::
$json_string = file_get_contents('./Initial_forum_post.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // ::::::::::討論區4主題*2篇文+2公告發文::::::::::
            for($a=0 ; $a<10 ; $a++){
            $sql = "insert into forum_post (forum_post_poster,forum_post_category,forum_post_title,forum_post_innertext ) value  ('".$data[$a]['forum_post_poster']."','".$data[$a]['forum_post_category']."','".$data[$a]['forum_post_title']."','".$data[$a]['forum_post_innertext']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }
			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}



// ::::::::::這是comment_post討論區留言+揪團留言的建立::::::::::
$json_string = file_get_contents('./Initial_comment_post.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
           // :::::::::: 8篇文*2留言 + 2公告*3留言::::::::::
            for($a=0 ; $a<22 ; $a++){
            $sql = "insert into comment_post (comment_poster,comment_class,forum_post_no,comment_innertext) value  ('".$data[$a]['comment_poster']."','".$data[$a]['comment_class']."','".$data[$a]['forum_post_no']."','".$data[$a]['comment_innertext']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }
            // :::::::::: 4篇文*3留言::::::::::
            for($a=23 ; $a<34 ; $a++){
            $sql = "insert into comment_post (comment_poster,comment_class,tour_post_no,comment_innertext) value  ('".$data[$a]['comment_poster']."','".$data[$a]['comment_class']."','".$data[$a]['tour_no']."','".$data[$a]['comment_innertext']."');";
            echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }


			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}


// ::::::::::這是orders訂單的建立::::::::::
$json_string = file_get_contents('./Initial_orders.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // :::::::::: 3筆訂單::::::::::
            for($a=0 ; $a<3 ; $a++){
            $sql = "insert into orders (member_no,order_total,order_logistics_fee,order_discount,order_logistics_deliver,order_logistics_recipient,order_logistics_phone,order_logistics_address,order_cashflow) value  ('".$data[$a]['member_no']."','".$data[$a]['order_total']."','".$data[$a]['order_logistics_fee']."','".$data[$a]['order_discount']."','".$data[$a]['order_logistics_deliver']."','".$data[$a]['order_logistics_recipient']."','".$data[$a]['order_logistics_phone']."','".$data[$a]['order_logistics_address']."','".$data[$a]['order_cashflow']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}

    
// ::::::::::這是order_list訂單的建立::::::::::
$json_string = file_get_contents('./Initial_order_list.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // :::::::::: 3筆訂單的詳細::::::::::
            for($a=0 ; $a<9 ; $a++){
            $sql = "insert into order_list (order_no,product_no,product_number,product_price) value  ('".$data[$a]['order_no']."','".$data[$a]['product_no']."','".$data[$a]['product_number']."','".$data[$a]['product_price']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }



			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
	}


// ::::::::::這是fmem_achievement擁有成就的建立::::::::::
$json_string = file_get_contents('./Initial_mem_achievement.json');  
$data = json_decode($json_string, true);  
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
		if($pdo != false){
			echo "連線成功<br>";
            // :::::::::: 擁有成就::::::::::
            for($a=0 ; $a<105 ; $a++){
            $sql = "insert into mem_achievement (mem_no,achievement_no) value  ('".$data[$a]['mem_no']."','".$data[$a]['achievement_no']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }


			echo "<br>異動成功<br>";
		}	else	{
			echo "<br>失敗ㄌ<br>";
		}
	}	catch	(PDOException $e)	{
		echo "錯誤原因：",$e->getMessage(), "<br>";
		echo "錯誤行號：",$e->getLine(),"<br>";
    }
    
// ::::::::::這是member_realname實名制審核的建立::::::::::
    $json_string = file_get_contents('./Initial_member_realname.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 實名制審核 ::::::::::
                for($a=0 ; $a<11 ; $a++){
                $sql = "insert into member_realname (mem_idno,mem_no,mem_realname,mem_idno_image) value  ('".$data[$a]['mem_idno']."','".$data[$a]['mem_no']."','".$data[$a]['mem_realname']."','".$data[$a]['mem_idno_image']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }

    // ::::::::::這是member_guide嚮導審核的建立::::::::::
    $json_string = file_get_contents('./Initial_member_guide.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 嚮導審核 ::::::::::
                for($a=0 ; $a<12 ; $a++){
                $sql = "insert into member_guide (guide_no,mem_no,guide_period_start,guide_period_end,guide_image) value  ('".$data[$a]['guide_no']."','".$data[$a]['mem_no']."','".$data[$a]['guide_period_start']."',date_add('".$data[$a]['guide_period_start']."', interval 4 year),'".$data[$a]['guide_image']."');";
                echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }


                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }
    

// ::::::::::這是member_keep會員追蹤的建立::::::::::
    $json_string = file_get_contents('./Initial_member_keep.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 會員追蹤 ::::::::::
                for($a=0 ; $a<21 ; $a++){
                $sql = "insert into member_keep (mem_keep_mem,mem_iskept_mem) value  ('".$data[$a]['mem_keep_mem']."','".$data[$a]['mem_iskept_mem']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
    
    
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }

// ::::::::::這是tour_keep揪團追蹤的建立::::::::::
$json_string = file_get_contents('./Initial_tour_keep.json');  
$data = json_decode($json_string, true);  
try	{
    $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
    $user = "root";
    $password = "root";
    $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn , $user , $password, $options);
        if($pdo != false){
            echo "連線成功<br>";
            // :::::::::: 揪團追蹤 ::::::::::
            for($a=0 ; $a<21 ; $a++){
            $sql = "insert into tour_keep (tour_keep_mem,tour_iskept_tour) value  ('".$data[$a]['tour_keep_mem']."','".$data[$a]['tour_iskept_tour']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }


            echo "<br>異動成功<br>";
        }	else	{
            echo "<br>失敗ㄌ<br>";
        }
    }	catch	(PDOException $e)	{
        echo "錯誤原因：",$e->getMessage(), "<br>";
        echo "錯誤行號：",$e->getLine(),"<br>";
    }

    



// ::::::::::這是product_keep商品收藏的建立::::::::::
    $json_string = file_get_contents('./Initial_product_keep.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 商品收藏::::::::::
                for($a=0 ; $a<22 ; $a++){
                $sql = "insert into product_keep (product_keep_mem,product_iskept_no) value  ('".$data[$a]['product_keep_mem']."','".$data[$a]['product_iskept_no']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
    
    
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }

    
// ::::::::::這是forum_keep討論文收藏的建立::::::::::
    $json_string = file_get_contents('./Initial_forum_keep.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 討論文收藏::::::::::
                for($a=0 ; $a<15 ; $a++){
                $sql = "insert into forum_keep (forum_keep_mem,forum_iskept_post) value  ('".$data[$a]['forum_keep_mem']."','".$data[$a]['forum_iskept_post']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
    
    
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }


// ::::::::::這是tour_participate揪團參加的建立::::::::::
    $json_string = file_get_contents('./Initial_tour_participate.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 會員追蹤 ::::::::::
                for($a=0 ; $a<13 ; $a++){
                $sql = "insert into tour_participate (tour_participate_mem,tour_participate_tour,tour_participate_situation) value  ('".$data[$a]['tour_participate_mem']."','".$data[$a]['tour_participate_tour']."','".$data[$a]['tour_participate_situation']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
    
    
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }

        

// ::::::::::這是tour_report揪團檢舉的建立::::::::::
    $json_string = file_get_contents('./Initial_tour_report.json');  
    $data = json_decode($json_string, true);  
    try	{
        $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
        $user = "root";
        $password = "root";
        $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn , $user , $password, $options);
            if($pdo != false){
                echo "連線成功<br>";
                // :::::::::: 揪團檢舉 ::::::::::
                for($a=0 ; $a<13 ; $a++){
                $sql = "insert into tour_report (tour_report_mem,tour_report_tour,tour_report_reason,tour_report_situation) value  ('".$data[$a]['tour_report_mem']."','".$data[$a]['tour_report_tour']."','".$data[$a]['tour_report_reason']."','".$data[$a]['tour_report_situation']."');";
               echo $sql."<br>";
                $affectedRow = $pdo -> exec($sql);
                }
    
    
                echo "<br>異動成功<br>";
            }	else	{
                echo "<br>失敗ㄌ<br>";
            }
        }	catch	(PDOException $e)	{
            echo "錯誤原因：",$e->getMessage(), "<br>";
            echo "錯誤行號：",$e->getLine(),"<br>";
        }

    



// ::::::::::這是forum_report揪團檢舉的建立::::::::::
$json_string = file_get_contents('./Initial_forum_report.json');  
$data = json_decode($json_string, true);  
try	{
    $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
    $user = "root";
    $password = "root";
    $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn , $user , $password, $options);
        if($pdo != false){
            echo "連線成功<br>";
            // :::::::::: 揪團檢舉 ::::::::::
            for($a=0 ; $a<13 ; $a++){
            $sql = "insert into forum_report (forum_report_mem,forum_report_post,forum_report_reason,forum_report_situation) value  ('".$data[$a]['forum_report_mem']."','".$data[$a]['forum_report_post']."','".$data[$a]['forum_report_reason']."','".$data[$a]['forum_report_situation']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }


            echo "<br>異動成功<br>";
        }	else	{
            echo "<br>失敗ㄌ<br>";
        }
    }	catch	(PDOException $e)	{
        echo "錯誤原因：",$e->getMessage(), "<br>";
        echo "錯誤行號：",$e->getLine(),"<br>";
    }



// ::::::::::這是comment_report留言檢舉的建立::::::::::
$json_string = file_get_contents('./Initial_comment_report.json');  
$data = json_decode($json_string, true);  
try	{
    $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
    $user = "root";
    $password = "root";
    $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn , $user , $password, $options);
        if($pdo != false){
            echo "連線成功<br>";
            // :::::::::: 留言檢舉 ::::::::::
            for($a=0 ; $a<13 ; $a++){
            $sql = "insert into comment_report (comment_report_mem,comment_report_comment,comment_report_reason,comment_report_sitution) value  ('".$data[$a]['comment_report_mem']."','".$data[$a]['comment_report_comment']."','".$data[$a]['comment_report_reason']."','".$data[$a]['comment_report_sitution']."');";
           echo $sql."<br>";
            $affectedRow = $pdo -> exec($sql);
            }


            echo "<br>異動成功<br>";
        }	else	{
            echo "<br>失敗ㄌ<br>";
        }
    }	catch	(PDOException $e)	{
        echo "錯誤原因：",$e->getMessage(), "<br>";
        echo "錯誤行號：",$e->getLine(),"<br>";
    }


?>