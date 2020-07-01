<?php
$myText = "coucou";
?>
<html>
<head>
<!-- add js tag here -->
  <script>
    const addItem = () => { 
      let transactionItems = document.getElementById('transaction_items');
      const clone = transactionItems.firstChild.cloneNode(true);
      transactionItems.appendChild(clone);
      for(let i = 0; i < transactionItems.childElementCount ; i++) {
        transactionItems.children[i].children[1].setAttribute("name", "item_value_" + i);
      }
    };
  </script>
</head>
<body>
  <div>
  </div>
<form id="transaction_form" action="/redirection.html">
  <div id="transaction_items">
    <div> 
      <label>Item Price:</label><br>
      <input type="text" name="item_value_0" value="0"><br><br>
    </div>
  </div>
  <button type="button" onclick="addItem();">Add item</button> 
  <input type="submit" value="Submit">
</form>
</body>
</html>
