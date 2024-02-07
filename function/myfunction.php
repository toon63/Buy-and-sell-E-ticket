<?php

include_once('config.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}
function findEvent($search){
    global $con;
    $query = "SELECT * FROM event_detail WHERE event_name LIKE '%$search%'";
    return $query_run = mysqli_query($con, $query);
}
function getAllStartEvent($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE event_status = 'accepted' order by event_sell desc";
    return $query_run = mysqli_query($con, $query);
}
function getAllSoonEvent($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE event_status = 'accepted' AND event_sell> NOW() order by event_sell desc";
    return $query_run = mysqli_query($con, $query);
}
function getAllSellingEvent($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE event_status = 'accepted' AND event_sell<= NOW() AND event_endsell>=NOW() order by event_sell desc";
    return $query_run = mysqli_query($con, $query);
}
function getPendingEvent()
{
    global $con;
    $query = "SELECT * FROM event_detail e,ognz_profile o WHERE e.event_status = 'pending' AND e.event_ognz = o.ognz_id order by e.event_sell desc";
    return $query_run = mysqli_query($con, $query);
}
function getPendingOneEvent($event)
{
    global $con;
    $query = "SELECT * FROM event_detail e,ognz_profile o WHERE e.event_id=$event AND e.event_status = 'pending' AND e.event_ognz = o.ognz_id order by e.event_sell desc";
    return $query_run = mysqli_query($con, $query);
}
function getOne($table, $event)
{
    global $con;
    $query = "SELECT * FROM $table WHERE event_id='$event' ";
    return $query_run = mysqli_query($con, $query);
}
function getUser($id)
{
    global $con;
    $query = "SELECT * FROM user_profile WHERE user_id='$id' ";
    return $query_run = mysqli_query($con, $query);
}
function getUserTicket($id)
{
    global $con;
    $query = "SELECT * FROM event_detail e,ticket t,qr q where t.tk_user_id = '$id' and t.ticket_status = 'sold' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}

function getUserSellingTicket($id)
{
    global $con;
    $query = "SELECT * FROM event_detail e,ticket t,qr q where t.tk_customer_id = '$id' and t.ticket_status = 'selling' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}
function getUserSuspendedTicket($id)
{
    global $con;
    $query = "SELECT * FROM event_detail e,ticket t,qr q where t.tk_user_id = '$id' and t.ticket_status = 'suspended' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}

function getUserSendingticket_sender($id)
{
    global $con;
    $query = "SELECT * FROM event_detail e,ticket t,qr q where t.tk_user_id = '$id' and t.ticket_status = 'sending' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}

function getUserSendingticket_receiver($id)
{
    global $con;
    $query = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.tk_customer_id = '$id' and t.ticket_status = 'sending' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}

function getMinprice($column, $table, $event)
{
    global $con;
    $query = "SELECT MIN($column) FROM $table WHERE tk_event_id='$event' ";
    return $query_run = mysqli_query($con, $query);
}
function getTicket($column1, $column2, $table, $event)
{
    global $con;
    $query = "SELECT DISTINCT $column1 , $column2 FROM $table WHERE tk_event_id=$event ";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type,ticket_price,tk_event_id FROM ticket WHERE tk_event_id=$event and tk_user_id IS NULL and tk_customer_id IS NULL";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType1($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id FROM ticket WHERE tk_event_id=$event and tk_user_id IS NULL LIMIT 1 OFFSET 0";
    return $query_run = mysqli_query($con, $query);
}
function countAllTicketType($type1,$event)
{
    global $con;
    $query = "SELECT COUNT(*) as t_all FROM ticket WHERE ticket_type='$type1' AND tk_event_id=$event";
    return $query_run = mysqli_query($con, $query);
}
function countSoldTicketType($type,$event)
{
    global $con;
    $query = "SELECT COUNT(*) as t_sold FROM ticket WHERE ticket_type='$type' AND tk_event_id=$event and ticket_status != 'non' and ticket_status != 'inactive'";
    return $query_run = mysqli_query($con, $query);
}

function countSoldTicketType1($type1,$event)
{
    global $con;
    $query = "SELECT COUNT(*) as t1_sold FROM ticket WHERE ticket_type='$type1' AND tk_event_id=$event and ticket_status != 'non'";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType2($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id FROM ticket WHERE tk_event_id=$event and tk_user_id IS NULL LIMIT 1 OFFSET 1";
    return $query_run = mysqli_query($con, $query);
}
function countSoldTicketType2($type2,$event)
{
    global $con;
    $query = "SELECT COUNT(*) as t2_sold FROM ticket WHERE ticket_type='$type2' AND tk_event_id=$event and ticket_status != 'non'";
    return $query_run = mysqli_query($con, $query);
}
function getAllTicketType2($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id FROM ticket WHERE tk_event_id=$event and tk_user_id IS NULL LIMIT 1 OFFSET 1";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType3($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id , tk_customer_id FROM ticket WHERE tk_event_id=$event and tk_user_id IS NULL LIMIT 1 OFFSET 2";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType4($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id , tk_customer_id FROM ticket WHERE tk_event_id=$event IS NULL LIMIT 1 OFFSET 3";
    return $query_run = mysqli_query($con, $query);
}

function getTicketType5($event)
{
    global $con;
    $query = "SELECT DISTINCT ticket_type, ticket_price , tk_event_id FROM ticket WHERE tk_event_id=$event LIMIT 1 OFFSET 4";
    return $query_run = mysqli_query($con, $query);
}

function t1($con, $type1 , $num_type1 , $price1 , $priceall , $buyer, $event) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $check1 = "SELECT * FROM ticket t,event_detail e WHERE t.tk_user_id is null AND t.ticket_type = '$type1' AND t.tk_event_id = $event AND t.tk_event_id = e.event_id LIMIT 1";
    $c1data = mysqli_query($con ,$check1);
    foreach($c1data as $c1){
    if ($c1['ticket_status'] == 'non'){
        $c1_oid = $c1['event_ognz'];
        $c1_share = $c1['event_share'];

        $c1_non1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type1' and tk_event_id = $event and tk_user_id is null LIMIT 1";
        mysqli_query($con, $c1_non1);

        $c1_non2 = "UPDATE user_profile SET point = point-$price1 WHERE user_id = $buyer LIMIT 1";
        mysqli_query($con, $c1_non2);

        $total1 = ((100-$c1_share)/100)*$price1;

        $c1_non3 = "UPDATE ognz_profile SET point = point+$total1 WHERE ognz_id = $c1_oid LIMIT 1";
        mysqli_query($con, $c1_non3);
    }elseif($c1['ticket_status'] == 'selling'){
        $c1_cid = $c1['tk_customer_id'];
        $c1_share = $c1['event_share'];

        $c1_sell1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type1' and tk_event_id = $event and tk_user_id is null LIMIT 1";
        mysqli_query($con, $c1_sell1);

        $c1_sell2 = "UPDATE user_profile SET point = point-$price1 WHERE user_id = $buyer LIMIT 1";
        mysqli_query($con, $c1_sell2);

        $total1 = ((100-$c1_share)/100)*$price1;

        $c1_sell3 = "UPDATE user_profile SET point = point+$total1 WHERE user_id = $c1_cid LIMIT 1";
        mysqli_query($con, $c1_sell3);

        $c1_sell4 = "INSERT INTO transaction_history(point,status,transaction_event_id,transaction_user_id,transaction_ticket_id) VALUE ($price1,'sold',$event,$c1_cid,$event)";
        mysqli_query($con, $c1_sell4);
    }
    mysqli_commit($con);
    echo "Transaction committed successfully.";
}
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function t2($con, $type2 , $num_type2 , $price2 , $priceall , $buyer, $event) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $check2 = "SELECT * FROM ticket t,event_detail e WHERE t.tk_user_id is null AND t.ticket_type = '$type2' AND t.tk_event_id = $event AND t.tk_event_id = e.event_id LIMIT 1";
    $c2data = mysqli_query($con ,$check2);
    foreach($c2data as $c2){
    if ($c2['ticket_status'] == 'non'){
        $oid = $c2['event_ognz'];
        $c2_share = $c2['event_share'];

        $non1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT 1";
        mysqli_query($con, $non1);

        $non2 = "UPDATE user_profile SET point = point - $price2 WHERE user_id = $buyer LIMIT 1";
        mysqli_query($con, $non2);

        $total2 = ((100-$c2_share)/100)*$price2;

        $non3 = "UPDATE ognz_profile SET point = point + $total2 WHERE ognz_id = $oid LIMIT 1";
        mysqli_query($con, $non3);
    }elseif($c2['ticket_status'] == 'selling'){
        $cid = $c2['tk_customer_id'];
        $c2_share = $c2['event_share'];

        $sell1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT 1";
        mysqli_query($con, $sell1);

        $sell2 = "UPDATE user_profile SET point = point-$price2 WHERE user_id = $buyer LIMIT 1";
        mysqli_query($con, $sell2);

        $total2 = ((100-$c2_share)/100)*$price2;

        $sell3 = "UPDATE user_profile SET point = point+$total2 WHERE user_id = $cid LIMIT 1";
        mysqli_query($con, $sell3);

        $sell4 = "INSERT INTO transaction_history(point,status,transaction_event_id,transaction_user_id,transaction_ticket_id) VALUE ($price2,'sold',$event,$cid,$event)";
        mysqli_query($con, $sell4);

    }
    mysqli_commit($con);
    echo "Transaction committed successfully.";
}
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function clear_cus($con, $buyer, $event) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $clear = "UPDATE ticket SET tk_customer_id = null WHERE tk_event_id = $event AND tk_user_id = $buyer AND tk_customer_id is not null LIMIT 1";
    mysqli_query($con, $clear);

    mysqli_commit($con);
    echo "Transaction committed successfully.";
}
 catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

// function t12($con, $type1 , $type2 , $num_type1 , $num_type2 , $price1 , $price2 , $priceall , $buyer, $event){

//     mysqli_autocommit($con, false);
    
//     mysqli_begin_transaction($con);

// try {
//     $check = "SELECT * FROM ticket t,event_detail e WHERE t.tk_user_id is null AND t.ticket_type = '$type2' AND t.tk_event_id = $event LIMIT 1";
//     $c1data = mysqli_query($con ,$check);
//     foreach($c1data as $c1){
//     if ($c1['ticket_status'] == 'non'){
//         $oid = $c1['event_ognz'];

//         $non1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT 1";
//         mysqli_query($con, $non1);

//         $non2 = "UPDATE user_profile SET point = point-$price2 WHERE user_id = $buyer LIMIT 1";
//         mysqli_query($con, $non2);

//         $non3 = "UPDATE ognz_profile SET point = point+$price2 WHERE ognz_id = $oid LIMIT 1";
//         mysqli_query($con, $non3);
//     }elseif($c1['ticket_status'] == 'selling'){
//         $cid = $c1['tk_customer_id'];

//         $sell1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT 1";
//         mysqli_query($con, $sell1);

//         $sell2 = "UPDATE user_profile SET point = point-$price2 WHERE user_id = $buyer LIMIT 1";
//         mysqli_query($con, $sell2);

//         $sell3 = "UPDATE user_profile SET point = point+$price2 WHERE user_id = $cid LIMIT 1";
//         mysqli_query($con, $sell3);
//     }
//     mysqli_commit($con);
//     echo "Transaction committed successfully.";
// }
// } catch (Exception $e) {
//     mysqli_rollback($con);
//     echo "Transaction failed: " . $e->getMessage();
// }
// }



// function t1s($con, $type1 , $num_type1 , $price1 , $priceall , $buyer, $event) {

//     mysqli_autocommit($con, false);
    
//     mysqli_begin_transaction($con);

// try {
//     $check = "SELECT * FROM ticket t,event_detail e WHERE t.tk_user_id = $buyer AND t.ticket_type = '$type1' AND t.tk_event_id = $event LIMIT $num_type1";
//     $c1 = mysqli_query($con, $check);
//     foreach($c1 as $c1data){
//         if ($c1data['ticket_status'] == 'selling'){
//             $cid = $c1data['tk_customer_id'];
//             $sl1 = "UPDATE user_profile SET point = point-$price1 WHERE user_id = $buyer LIMIT 1";
//             $sl2 = "UPDATE user_profile SET point = point+$price1 WHERE user_id = $cid LIMIT 1";
//             $sl3 = "UPDATE ticket SET tk_customer_id = null , ticket_status = 'sold' WHERE tk_user_id = $buyer LIMIT 1";

//             $sl1 = mysqli_query($con, $sl1);
//             $sl2 = mysqli_query($con, $sl2);
//             $sl3 = mysqli_query($con, $sl3);
//         }elseif($c1data['ticket_status'] == 'non'){
//             $oid = $c1data['event_ognz'];
//             $bl1 = "UPDATE user_profile SET point = point-$price1 WHERE user_id = $buyer LIMIT 1";
//             $bl2 = "UPDATE ognz_profile SET point = point+$price1 WHERE ognz_id = $oid LIMIT 1";
//             $bl3 = "UPDATE ticket SET tk_customer_id = null, ticket_status = 'sold' WHERE tk_user_id = $oid LIMIT 1";
//             $bl1 = mysqli_query($con, $bl1);
//             $bl2 = mysqli_query($con, $bl2);
//             $bl3 = mysqli_query($con, $bl3);
//         }
//     }

//     mysqli_commit($con);
//     echo "Transaction committed successfully.";
// } catch (Exception $e) {
//     mysqli_rollback($con);
//     echo "Transaction failed: " . $e->getMessage();
// }
// }

// function t2s($con, $type2 , $num_type2 , $price2 , $priceall , $buyer, $event) {

//     mysqli_autocommit($con, false);
    
//     mysqli_begin_transaction($con);

// try {
//     $query1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT $num_type2";
//     mysqli_query($con, $query1);

//     $query2 = "UPDATE user_profile SET point = point - $priceall WHERE user_id = $buyer";
//     mysqli_query($con, $query2);

//     mysqli_commit($con);
//     echo "Transaction committed successfully.";
// } catch (Exception $e) {
//     mysqli_rollback($con);
//     echo "Transaction failed: " . $e->getMessage();
// }
// }

// function t12s($con, $type1 , $type2 , $num_type1 , $num_type2 , $price1 , $price2 , $priceall , $buyer, $event) {

//     mysqli_autocommit($con, false);
    
//     mysqli_begin_transaction($con);

// try {
//     $query1 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type1' and tk_event_id = $event and tk_user_id is null LIMIT $num_type1";
//     mysqli_query($con, $query1);

//     $query2 = "UPDATE ticket SET tk_user_id = $buyer , ticket_status = 'sold' WHERE ticket_type = '$type2' and tk_event_id = $event and tk_user_id is null LIMIT $num_type2";
//     mysqli_query($con, $query2);

//     $query3 = "UPDATE user_profile SET point = point - $priceall WHERE user_id = $buyer";
//     mysqli_query($con, $query3);

//     mysqli_commit($con);
//     echo "Transaction committed successfully.";
// } catch (Exception $e) {
//     mysqli_rollback($con);
//     echo "Transaction failed: " . $e->getMessage();
// }
// }

function num_t1($type1, $event) {
    global $con;
    $query1 = "SELECT COUNT(*) as t1_left FROM ticket WHERE ticket_type = '$type1' AND tk_event_id = $event AND tk_user_id is null";
    return $query_run = mysqli_query($con, $query1);
}

function num_t2($type2, $event) {
    global $con;
    $query1 = "SELECT COUNT(*) as t2_left FROM ticket WHERE ticket_type = '$type2' AND tk_event_id = $event AND tk_user_id is null";
    return $query_run = mysqli_query($con, $query1);
}
function transaction_history($con, $type1 , $type2 , $num_type1 , $num_type2 , $price1 , $price2 , $buyer, $event) {
    global $con;
    if ($num_type1 > 0 && $num_type2 == '0'){
        $query1 = "SELECT ticket_id FROM ticket WHERE ticket_type = '$type1' AND tk_user_id = $buyer ORDER BY ticket_id DESC LIMIT $num_type1";
        $r1 = mysqli_query($con,$query1);
        foreach($r1 as $r1data){
            $r1tid = $r1data['ticket_id'];
            $r1q = "INSERT INTO transaction_history (point , status , transaction_event_id , transaction_user_id , transaction_ticket_id) VALUES ($price1 , 'buy' , $event , $buyer , $r1tid)";
            mysqli_query($con,$r1q);
        }
    }elseif ($num_type1 == '0' && $num_type2 > 0){
        $query2 = "SELECT ticket_id FROM ticket WHERE ticket_type = '$type2' AND tk_user_id = $buyer ORDER BY ticket_id DESC LIMIT $num_type2";
        $r2 = mysqli_query($con,$query2);
        foreach($r2 as $r2data){
            $r2tid = $r2data['ticket_id'];
            $r2q = "INSERT INTO transaction_history (point , status , transaction_event_id , transaction_user_id , transaction_ticket_id) VALUES ($price2 , 'buy' , $event , $buyer , $r2tid)";
            mysqli_query($con,$r2q);
        }
    }elseif ($num_type1 > 0 && $num_type2 > 0){
        $query3 = "SELECT ticket_id FROM ticket WHERE ticket_type = '$type1' AND tk_user_id = $buyer ORDER BY ticket_id DESC LIMIT $num_type1";
        $r3 = mysqli_query($con,$query3);
        foreach($r3 as $r3data){
            $r3tid = $r3data['ticket_id'];
            $r3q = "INSERT INTO transaction_history (point , status , transaction_event_id , transaction_user_id , transaction_ticket_id) VALUES ($price1 , 'buy' , $event , $buyer , $r3tid)";
            mysqli_query($con,$r3q);
        }
        $query4 = "SELECT ticket_id FROM ticket WHERE ticket_type = '$type2' AND tk_user_id = $buyer ORDER BY ticket_id DESC LIMIT $num_type2";
        $r4 = mysqli_query($con,$query4);
        foreach($r4 as $r4data){
            $r4tid = $r4data['ticket_id'];
            $r4q = "INSERT INTO transaction_history (point , status , transaction_event_id , transaction_user_id , transaction_ticket_id) VALUES ($price2 , 'buy' , $event , $buyer , $r4tid)";
            mysqli_query($con,$r4q);
        }
        

    }
}

function check_ticket($tid) {
    global $con;
    $query1 = "SELECT tk_user_id FROM ticket where ticket_id = $tid";
    return $query_run = mysqli_query($con, $query1);
}

function getOneTicket($tid) {
    global $con;
    $query1 = "SELECT * FROM ticket where ticket_id = $tid";
    return $query_run = mysqli_query($con, $query1);
}
function getOneUserTicket($id,$tid)
{
    global $con;
    $query = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_event_id,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.ticket_id = '$tid' AND t.tk_user_id = '$id' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    return $query_run = mysqli_query($con, $query);
}
function getqr($tid,$id)
{
    global $con;
    $result = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_event_id,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.ticket_id = '$tid' AND t.tk_customer_id = '$id' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    return $query_run = mysqli_query($con, $result);

}
function getOneUserSellingTicket($id,$tid)
{
    global $con;
    $query = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_event_id,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.ticket_id = '$tid' AND t.tk_customer_id = '$id' and t.ticket_status = 'selling' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";   
    return $query_run = mysqli_query($con, $query);
}

function getOneUserSendingTicket($id,$tid)
{
    global $con;
    $query = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_event_id,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.ticket_id = '$tid' AND t.tk_user_id = '$id'  and t.ticket_status = 'sending' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";   
    return $query_run = mysqli_query($con, $query);
}

function getOneUserReceiveticket($id,$tid)
{
    global $con;
    $query = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.tk_customer_id = '$id' and t.ticket_status = 'sending' and t.ticket_id = $tid and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
    
    return $query_run = mysqli_query($con, $query);
}
function receive_ticket($con,$tid,$sender,$receiver,$point)
{

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE ticket SET tk_user_id = $receiver,tk_customer_id = null,ticket_status='sold' WHERE ticket_id = $tid AND tk_user_id = $sender AND tk_customer_id = $receiver";
    mysqli_query($con, $query1);
    $query2 = "INSERT INTO transfer_history (transfer_status , point , transfer_user_id , transfer_ticket_id , customer_transfer_id) VALUES ('received' ,$point , $sender , $tid , $receiver)";
    mysqli_query($con, $query2);

    mysqli_commit($con);
    echo "Transaction committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}
function reject_ticket($con,$tid,$sender,$receiver)
{

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE ticket SET tk_customer_id = null,ticket_status='sold' WHERE ticket_id = $tid AND tk_user_id = $sender AND tk_customer_id = $receiver";
    mysqli_query($con, $query1);

    $query2 = "INSERT INTO transfer_history (transfer_status , point , transfer_user_id , transfer_ticket_id , customer_transfer_id) VALUES ('rejected' ,'' , $sender , $tid , $receiver )";
    mysqli_query($con, $query2);

    mysqli_commit($con);
    echo "Transaction committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}
function send($con,$tid,$sender,$reciver,$point){

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE ticket SET tk_customer_id = $reciver,ticket_status='sending' WHERE ticket_id = $tid AND tk_user_id = $sender";
    mysqli_query($con, $query1);

    $query2 = "INSERT INTO transfer_history (transfer_status , point , transfer_user_id , transfer_ticket_id , customer_transfer_id) VALUES ('send' ,$point , $sender , $tid , $reciver )";
    mysqli_query($con, $query2);

    mysqli_commit($con);
    echo "Transaction committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function myhistory($id) {
    global $con;
    $query1 = "SELECT * FROM transfer_history tf,transaction_history ts,ticket t,event_detail e where tf.transfer_user_id = '$id' and tf.transfer_ticket_id = t.ticket_id and ts.transaction_user_id = '$id' and ts.transaction_ticket_id = t.ticket_id and e.event_id = tr.transaction_event_id ORDER BY ts.transaction_date DESC";
    return $query_run = mysqli_query($con, $query1);
}

function tshistory($id) {
    global $con;
    $query1 = "SELECT * FROM transaction_history ts,ticket t,event_detail e where ts.transaction_user_id = '$id' AND t.ticket_id = ts.transaction_ticket_id AND ts.transaction_event_id = e.event_id order by ts.transaction_date DESC;";
    return $query_run = mysqli_query($con, $query1);
}
function tfhistory_sender($id) {
    global $con;
    $query1 = "SELECT * FROM transfer_history tf,ticket t,event_detail e,user_profile u where transfer_user_id = $id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND transfer_user_id = user_id order by tf.transfer_date DESC;";
    return $query_run = mysqli_query($con, $query1);
}
function tfhistory_receiver($id) {
    global $con;
    $query1 = "SELECT * FROM transfer_history tf,ticket t,event_detail e,user_profile u where customer_transfer_id = $id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND transfer_user_id = user_id order by tf.transfer_date DESC;";
    return $query_run = mysqli_query($con, $query1);
}


function getognz($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function sellback($con, $tid, $seller, $event ,$point) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE ticket SET tk_customer_id = tk_user_id WHERE ticket_id = $tid AND tk_user_id = $seller";
    mysqli_query($con, $query1);

    $query2 = "UPDATE ticket SET ticket_status = 'selling' , tk_user_id = null WHERE ticket_id = $tid AND tk_customer_id = $seller";
    mysqli_query($con, $query2);

    $query3 = "INSERT INTO transaction_history (status , point , transaction_event_id , transaction_user_id , transaction_ticket_id) VALUES ('selling' , $point , $event , $seller , $tid )";
    mysqli_query($con, $query3);

    mysqli_commit($con);
    echo "Transfer committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function cancelsell($con, $tid, $seller, $event ,$point) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE ticket SET tk_user_id = tk_customer_id WHERE ticket_id = $tid AND tk_customer_id = $seller";
    mysqli_query($con, $query1);

    $query2 = "UPDATE ticket SET ticket_status = 'sold' , tk_customer_id = null WHERE ticket_id = $tid AND tk_user_id = $seller";
    mysqli_query($con, $query2);

    mysqli_commit($con);
    echo "Transfer committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function cancelsend($con, $tid, $sender, $event ,$point) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {

    $query = "UPDATE ticket SET ticket_status = 'sold' , tk_customer_id = null WHERE ticket_id = $tid AND tk_user_id = $sender";
    mysqli_query($con, $query);

    mysqli_commit($con);
    echo "Transfer committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}

function getoneognz($table,$ognz_id)
{
    global $con;
    // $query = "SELECT * FROM " . $table ." WHERE ongz_id = " .$ognz_id;
    $query = "SELECT * FROM " . $table ." WHERE ognz_id = " .$_SESSION['ognz_id'];
    return $query_run = mysqli_query($con, $query);
}

function topup_point($con,$total,$user_id) {

    mysqli_autocommit($con, false);
    
    mysqli_begin_transaction($con);

try {
    $query1 = "UPDATE user_profile SET point = point+$total WHERE user_id = $user_id";
    mysqli_query($con, $query1);

    $query2 = "INSERT INTO point_history (transaction_type , point , point_ref_id, point_user_id) VALUES ('topup' , $total , '10001' , $user_id)";
    mysqli_query($con, $query2);

    mysqli_commit($con);
    echo "Transfer committed successfully.";
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "Transaction failed: " . $e->getMessage();
}
}
function getadmin($aid){
    global $con;
    $query = "SELECT * FROM admin_profile WHERE admin_id='$aid'";
    return $query_run = mysqli_query($con, $query);
}
function history_all_point()
{
    global $con;
    $query = "SELECT u.user_firstname,u.user_lastname,p.transaction_date,p.point FROM point_history p,user_profile u WHERE p.point_user_id=u.user_id ORDER BY p.transaction_date DESC";
    return  $query_run = mysqli_query($con,  $query);
}
function point_history($uid)
{
    global $con;
    $query = "SELECT * FROM point_history WHERE point_user_id=$uid";
    return  $query_run = mysqli_query($con,  $query);
}
function getallognz( )
{
    global $con;
    $query = "SELECT * FROM `ognz_profile`" ;
    return $query_run = mysqli_query($con, $query);
}
function countEventOgnz($ognz_id)
{
    global $con;
    $query = "SELECT COUNT(*) as event_ognz_count FROM event_detail WHERE event_ognz = '$ognz_id'" ;
    return $query_run = mysqli_query($con, $query);
}
function admin_tfhistory_sender() {
    global $con;
    $query1 = "SELECT * FROM transfer_history tf,ticket t,user_profile u,event_detail e where transfer_user_id = u.user_id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND tf.transfer_status = 'received' order by tf.transfer_date DESC;";
    return $query_run = mysqli_query($con, $query1);
}
function admin_tfhistory_receiver() {
    global $con;
    $query1 = "SELECT * FROM transfer_history tf,ticket t,user_profile u,event_detail e where customer_transfer_id = u.user_id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND tf.transfer_status = 'received' order by tf.transfer_date DESC;";
    return $query_run = mysqli_query($con, $query1);
}
function ognzEvent($ognz_id){
    global $con;
    $query = "SELECT * FROM event_detail WHERE event_ognz=$ognz_id";
    return $query_run = mysqli_query($con, $query);
}
function ognzEventCountAllTicket($eid){
    global $con;
    $query = "SELECT COUNT(*) as ticket_all_count FROM ticket WHERE tk_event_id = '$eid'";
    return $query_run = mysqli_query($con, $query);
}
function ognzEventCountAllSoldTicket($eid){
    global $con;
    $query = "SELECT COUNT(*) as ticket_sold_all_count FROM ticket WHERE tk_event_id = '$eid' AND ticket_status != 'non' AND ticket_status != 'inactive'";
    return $query_run = mysqli_query($con, $query);
}

function getPendingOneSettlement($sid)
{
    global $con;
    $query = "SELECT * FROM settlement_history s,ognz_profile o WHERE s.settlement_id = $sid AND s.settlement_status = 'pending' AND s.sh_ognz_id = o.ognz_id order by s.settlement_date";
    return $query_run = mysqli_query($con, $query);
}
function getSettlement()
{
    global $con;
    $query = "SELECT * FROM settlement_history s,ognz_profile o WHERE s.sh_ognz_id = o.ognz_id order by s.settlement_date DESC";
    return $query_run = mysqli_query($con, $query);
}
function getSuccessSettlement()
{
    global $con;
    $query = "SELECT * FROM settlement_history s,ognz_profile o WHERE s.sh_ognz_id = o.ognz_id AND s.settlement_status = 'success' order by s.settlement_date DESC";
    return $query_run = mysqli_query($con, $query);
}
function getPendingSettlement()
{
    global $con;
    $query = "SELECT * FROM settlement_history s,ognz_profile o WHERE s.settlement_status = 'pending' AND s.sh_ognz_id = o.ognz_id order by s.settlement_date";
    return $query_run = mysqli_query($con, $query);
}
function getOgnzPendingSettlement($oid)
{
    global $con;
    $query = "SELECT * FROM settlement_history WHERE settlement_status = 'pending' AND sh_ognz_id=$oid order by settlement_date";
    return $query_run = mysqli_query($con, $query);
}
function getognzprofile($oid)
{
    global $con;
    $query = "SELECT * FROM ognz_profile WHERE ognz_id=$oid";
    return $query_run = mysqli_query($con, $query);
}
function getallticket($eid)
{
    global $con;
    $query = "SELECT * FROM ticket t WHERE t.tk_event_id=$eid";
    return $query_run = mysqli_query($con, $query);
}
function getalltickettype($eid){
    global $con;
    $query = "SELECT DISTINCT ticket_type,ticket_price,tk_event_id FROM ticket WHERE tk_event_id=$eid";
    return $query_run = mysqli_query($con, $query);
}
function find_User($email){
    global $con;
    $query = "SELECT * FROM user_profile WHERE user_email='$email'";
    return $query_run = mysqli_query($con, $query);
}
function find_point_history($s1,$e1){
    global $con;

    // $s1 = date('Y-m-d', strtotime($s1 . ' -1 day'));
    $e1 = date('Y-m-d', strtotime($e1 . ' +1 day'));
    $query = "SELECT * FROM point_history p,user_profile u WHERE p.point_user_id=u.user_id AND p.transaction_date BETWEEN '$s1' AND '$e1' ORDER BY p.transaction_date DESC";
    return $query_run = mysqli_query($con, $query);
}
function find_exc_history_sender($s2,$e2){
    global $con;

    // $s1 = date('Y-m-d', strtotime($s1 . ' -1 day'));
    $e2 = date('Y-m-d', strtotime($e2 . ' +1 day'));
    $query = "SELECT * FROM transfer_history tf,ticket t,user_profile u,event_detail e where transfer_user_id = u.user_id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND tf.transfer_status = 'received' AND tf.transfer_date BETWEEN '$s2' AND '$e2' ORDER BY tf.transfer_date DESC";
    return $query_run = mysqli_query($con, $query);
}
function find_exc_history_receiver($s2,$e2){
    global $con;

    // $s1 = date('Y-m-d', strtotime($s1 . ' -1 day'));
    $e2 = date('Y-m-d', strtotime($e2 . ' +1 day'));
    $query = "SELECT * FROM transfer_history tf,ticket t,user_profile u,event_detail e where customer_transfer_id = u.user_id AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id AND tf.transfer_status = 'received' AND tf.transfer_date BETWEEN '$s2' AND '$e2' ORDER BY tf.transfer_date DESC";
    return $query_run = mysqli_query($con, $query);
}
function find_setttlement_history($s3,$e3){
    global $con;

    // $s1 = date('Y-m-d', strtotime($s1 . ' -1 day'));
    $e3 = date('Y-m-d', strtotime($e3 . ' +1 day'));
    $query = "SELECT * FROM settlement_history s,ognz_profile o WHERE s.sh_ognz_id = o.ognz_id AND s.settlement_status = 'success' AND s.settlement_date BETWEEN '$s3' AND '$e3' ORDER BY s.settlement_date DESC";
    return $query_run = mysqli_query($con, $query);
}