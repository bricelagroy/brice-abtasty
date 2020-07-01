<?php
$myText = "coucou";
?>
<html>
<head>
  <!-- add js tag here -->
  <script>
    const addItem = () => { 
      let transactionItems = document.getElementById('transaction_items');
      const clone = transactionItems.children[0].cloneNode(true);
      transactionItems.appendChild(clone);
      for(let i = 0; i < transactionItems.childElementCount ; i++) {
        transactionItems.children[i].getElementsByClassName('item_value')[0].setAttribute("name", "item_value_" + i);
      }
    };
  </script>
</head>
<body>
  <div>
  </div>
<form id="transaction_form" action="/connfirmation.html">
  <div id="action_tracking">
    <button>Useless button (for action tracking)</button>
  </div>
  <div id="transaction_items">
    <div> 
      <label>Item Price:</label><br>
      <input type="text" class="item_value" name="item_value_0" value="0"><br><br>
    </div>
  </div>
  <button type="button" onclick="addItem();">Add item</button> 
  <input type="submit" value="Buy">
</form>
</body>
</html>
