var tariff ={
//rural_customer
  r1:4,
  // commercial_customer
    c1:35.88,
    c2:43.72,
    c3:44.30,
  // industrial_customer
    d1:36.19,
    d2:44.01,
    d3:44.59 
}
//the above tarriff plan has tax rate included
const c = console.log.bind(console);

const transaction_fee_local = 0.015; //each transaction fee to be deducted from the card
const transaction_fee_international = 0.015; //each transaction fee to be deducted from the card


var aw = document.getElementById('warning');
var amount = document.getElementById('amount');
var tf = document.getElementById('tariff_plan').value;
var fee = document.getElementById('fee');
var fee_w = document.getElementById('fee_warning');

fee_w.style.display = "none";

c(Math.floor(100000 + Math.random() * 900000));

function total(){
  if(amount.value === ""){
  fee_w.style.display = "none";

  }
  else{
     fee_w.style.display = "block";
      let transfee =parseFloat(amount.value) * transaction_fee_local;
      fee.innerHTML = transfee.toFixed(1);
  }
}


aw.style.color="red";
aw.style.display="none";

function payWithPaystack(){
  
  if(amount.value >= 10 && amount.value != 0){
    let t_plan = parseFloat(tariff[tf]);
    let amountToPay = parseFloat(amount.value);
   
   
   fee_charge = amountToPay * transaction_fee_local;
   let unit = amountToPay / t_plan;
  

    var handler = PaystackPop.setup({
    key: 'pk_test_5326257775439d0e2cd47265066ca77aeaf1c7eb',
    phone: document.getElementById('phone').value,
    email: document.getElementById('email-address').value,
    amount: document.getElementById('amount').value*100,
    currency: 'NGN',
      
    metadata: {
     
       custom_fields: [
        {
          display_name: "Transaction charge",
          variable_name: "charge",
          value: fee_charge
      },
        {
          display_name: "Unit Purchased",
          variable_name: "unit",
          value: ~~unit
      },
          {
              display_name: "Meter Number",
              variable_name: "Meter Number",
              value: document.getElementById('meter_number').value
          },

          {
              display_name: "Activation code",
              variable_name: "Activation Code",
              value: ''+Math.floor((Math.random() * 100000000000) + 1)+''+ ~~unit
          //using an algorithm to tell the meter box how many unit it should activate
          //it cuts out the first 11 digits and the remaining is the amount of unit
          //while the 11 digits will standas the authorization code
            }
       ]
    },
    callback: function(response){
       
        window.location.replace("../ebills/verifypayment.php?reference="+response.reference);
        
    },
    onClose: function(){
        alert('Do you want to cancel this transaction?');
    }
  });
  handler.openIframe();

  }
  else{
    console.error('increase transaction');
    aw.style.display = 'block';
   const myTimeout = setTimeout(change, 3000);

  }
  
}

function change(){
  aw.style.display = 'none';
}

