<?php
class cartObj {
    private $userID;
    private $items = array();
    private $subtotals = array();
    private $total_price;
    private $total_price_tax;
    private $taxes;

    function __construct($user)
    {
        $this->userID = $user;
        $this->items = array();
        $this->subtotals = array();
        $this->total_price = 0;
        $this->taxes = 0;
        $this->total_price_tax = 0;
    }

    function addItem($itemID){
        if (array_key_exists($itemID, $this->items)){
            $this->items[$itemID] += 1;
        }else{
            $this->items = $this->items + array($itemID => 1);
        }
    }
    function updateQty($itemID, $newQty){
        if (array_key_exists($itemID, $this->items)){
            $this->items[$itemID] = $newQty;
        }else{
            $this->items = $this->items + array($itemID => $newQty);
        }

        if ($this->items[$itemID] == 0){
            unset($this->items[$itemID]);
        }
    }

    function addQty($itemID, $newQty){
        if (array_key_exists($itemID, $this->items)){
            $this->items[$itemID] += $newQty;
        }else{
            $this->items = $this->items + array($itemID => $newQty);
        }

        if ($this->items[$itemID] == 0){
            unset($this->items[$itemID]);
        }
    }

    function calcPrice(){
        $subtotal_array = array();
        $this->total_price = 0;
        $this->total_price_tax = 0;
        $this->taxes = 0;

        foreach($this->items as $item=>$qty){
        $query = "SELECT * FROM Products WHERE id = $item";
        $db = new DatabaseDAO();
        $connection = $db->getConnection();
        $result = mysqli_query($connection, $query);
        $addedItem = mysqli_fetch_assoc($result);

            $productSubtotal = $addedItem["itemPrice"] * $qty;
            $subtotal_array = $subtotal_array + array($item => $productSubtotal);
            $this->total_price = $this->total_price + $productSubtotal;
            $addedTax = $this->total_price * 0.05;
            $this->taxes = round ($addedTax, 2);
            $priceWithTax = $this->total_price + $addedTax;
            $this->total_price_tax = round($priceWithTax, 2);
        }
        $this->subtotals = $subtotal_array;
    }


    //setters and getters
    function getUserID(){return $this->userID;}
    function getItems(){return $this->items;}
    function getSubtotals(){return $this->subtotals;}
    function getTotal_price(){return $this->total_price;}
    function getTotal_price_Tax(){return $this->total_price_tax;}
    function setUserID($userID){$this->userID = $userID;}
    function setItems($items){$this->items = $items;}
    function setSubtotals($subtotals){$this->subtotals = $subtotals;}
    function setTotal_price($total_price){$this->total_price = $total_price;}
    function setTotal_price_Tax($total_price_tax){$this->total_price_tax = $total_price_tax;}
    function getTaxes(){return $this->taxes;}
    function setTaxes($taxes){$this->taxes = $taxes;}
}
