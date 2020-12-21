//định dạng tiền tệ

function number_formats (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


function number_format(amount) {
  neg = amount.charAt(0);
  amount= amount.replace(/\D/g, '');
  amount= amount.replace(/\./g  , '');
  amount= amount.replace(/\-/g, '');

  var numAmount = new Number(amount); 
  amount= numAmount .toFixed(0).replace(/./g, function(c, i, a) {
      return i > 0 && c !== "" && (a.length - i) % 3 === 0 ? "," + c : c;
  });

  if(neg == '-')
      return neg+amount;
  else
      return amount;
}
