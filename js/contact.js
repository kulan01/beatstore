let $name = $('#name');
let $message = $('#message');
let $email = $('#email');


$name.focus(() =>{
    
    $name.keyup(() =>{
        if(check_name($name.val())){
            
            $name.css('border-color','#ccc');
        }
        else{
           $name.css('border-color','red'); 
        }
    });
    
}).blur(() =>{
        if(check_name($name.val())){
            
            $name.css('border-color','#ccc');
        }
        else{
           $name.css('border-color','red'); 
        }
    });

$email.focus(() =>{
    
    $email.keyup(() =>{

        if(!isEmail($email.val())){
            $email.css('border-color','red');
        }
        else{
           $email.css('border-color','#ccc'); 
        }
    });
    
}).blur(() =>{

        if(!isEmail($email.val())){
            $email.css('border-color','red');
        }
        else{
           $email.css('border-color','#ccc'); 
        }
    })

    //With this code, the message field will be validated to ensure it is not empty or contains only whitespace characters.
    
    $message.focus(() => {
        $message.keyup(() => {
            if (check_message($message.val())) {
                $message.css('border-color', '#ccc');
            } else {
                $message.css('border-color', 'red');
            }
        });
    }).blur(() => {
        if (check_message($message.val())) {
            $message.css('border-color', '#ccc');
        } else {
            $message.css('border-color', 'red');
        }
    });

//$("button[type='submit']").click((event) =>{
//    let $form = $('#contact form');
//    let $label = $('<label></label>');
//
//    event.preventDefault();
//    if(check_name($name.val()) && isEmail($email.val()) && $message !=""){
//
//       
//        $.ajax({
//          url : 'contact.php',
//          method : 'post',
//          data: {
//            name : $name.val(),
//            email : $email.val(),
//            message : $message.val()
//          },
//          success : (msg) =>{
//            $label.text('Message Was Send').addClass('alert alert-success');
//            console.log(msg);
//          }
//        });
//    }
//    else{
//        $label.text('Make sure you filled everything correctly.').addClass('alert alert-danger');
//        
//    
//    }
//    $form.prepend($label);
//    
//    
//});
function check_name(name){
    return (name.length > 3);
}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function check_message(message) {
    return (message.trim() !== ''); // Validate if the message is not empty or contains only whitespace
}