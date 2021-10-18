<?php
$myText = "Buy";
?>
<html>
<head>
  <script type="text/javascript" src="https://try.abtasty.com/66f086887bc08ea6de5b972880d51252.js"></script>
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
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "8xhsc43dzr");
    </script>
</head>
<body>
  <div id="action_tracking">
    <button>Useless button (for action tracking)</button>
  </div>
<form id="transaction_form" action="/confirmation.html">
  <div id="transaction_items">
    <div> 
      <label>Item Price:</label><br>
      <input type="text" class="item_value" name="item_value_0" value="0"><br><br>
    </div>
  </div>
  <button type="button" onclick="addItem();">Add item</button> 
  <input type="submit" value="<?php echo $myText; ?>">
</form>
</body>
</html>
