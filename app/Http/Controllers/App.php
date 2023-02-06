<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; //Veri Tabanı İşlemleri

//! Zaman
use Carbon\Carbon;
Carbon::now('Europe/Istanbul');
Carbon::setLocale('tr');
//! Zaman Son

class App extends Controller
{
    
  //! Login
  public function Login()
  {
   
     //! Cookie Silme 
     setcookie("name",'',time()-86400); 
     setcookie("surname",'',time()-86400); 
     setcookie("userImageUrl",'',time()-86400); 
     setcookie("userID",'',time()-86400); 
     setcookie("userRoleToken",'',time()-86400); 
     
     setcookie("userCheck",'',time()-86400); 
     setcookie("userToken",'',time()-86400); 
     setcookie("categoryTitle",'',time()-86400); 
     setcookie("categoryToken",'',time()-86400); 
     
     setcookie("companyToken",'',time()-86400); 
     setcookie("companyId",'',time()-86400); 
     //! Cookie Silme Son 
     
   
     return view('login');
  } //! Login Son
  
  //Admin - Login
  public function LoginControl(Request $request)
  {
     try {
    
         //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $email= $request->email;
         $password= $request->password;
      
         //! Tanım
         $loginCheck=0;
         $userToken="";
         $userID="";
         $adminCheck=0;
         $activeCheck =0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/loginOnline";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'email'=>  $email,
            'password'=> $password
         );
         

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
    
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);
          

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $userToken=$decoded["userToken"];
            $userID=$decoded["userId"];
            $userInfo= $decoded["userInfo"];           
            
            
            if(isset($decoded["userInfo"]["adminCheck"])) { $adminCheck= $decoded["userInfo"]["adminCheck"]; }
            else { $adminCheck = 0; }
          
            if($decoded["userInfo"]["isActive"] == true) { $activeCheck = 1;  }
            else { $activeCheck = 0; }
            
            
            //! Tanım
            $loginCheck = $decoded["status"];
               
         }

         //kapat
         curl_close($curl);
         
         
         // echo "activeCheck: "; echo $activeCheck; echo "<br/>";
         // echo "adminCheck: "; echo $adminCheck; die();
         
         
         //! Login Durumuna yönlendirme
         if($loginCheck == 1) {
            
            if($adminCheck == 0) {
               
               $urlTo = 'user_admin_check?userToken='.$userToken;
               return redirect($urlTo)->with('userToken',$userToken);
            }
            else if($activeCheck == 0) { return redirect()->route('account.block'); }
            else { return redirect()->route('index')->with('status',"succes")->with('userToken',$userToken)->with('userID',$userID)->with('userInfo',$userInfo); }
            
         }
         else {
            return redirect()->route('login')->with('status',"error")->with('msg',"Email veya Şifre hatalı olabilir.");
         }
         
      
     } catch (\Throwable $th) {
          
        return view('error500');
     }
  } //! Admin - Login Son
  
      
  //! Register
  public function Register()
  {
     //! Cookie Silme 
     setcookie("name",'',time()-86400); 
     setcookie("surname",'',time()-86400); 
     setcookie("userImageUrl",'',time()-86400); 
     
     setcookie("userCheck",'',time()-86400); 
     setcookie("userToken",'',time()-86400); 
     setcookie("categoryTitle",'',time()-86400); 
     setcookie("categoryToken",'',time()-86400); 
     
     setcookie("companyToken",'',time()-86400); 
     setcookie("companyId",'',time()-86400); 
     //! Cookie Silme Son 
   
     return view('register');
  } //! Register Son
  
  
  //! Register - Control
  public function RegisterControl(Request $request)
  {
      //! Kayıt Olma
      try 
      {
      
         //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $name= $request->name;
         $surname= $request->surname;
         $email= $request->email;
         $dateofBirth= $request->dateofBirth;
         $password= $request->password;
         $repassword= $request->repassword;
         
         
         if($password !=  $repassword ) {
            return redirect()->route('register')->with('status',"error")->with('msg',"Sifreler Uyuşmuyor.");
         }
         else {   
         
            //! Tanım
            $registerCheck=0;
            $message="";
            $userToken="";
         
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/user/add";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverId' => env('YILDIRIMDEV_ServerId'),
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'name'=>  $name,
               'surname'=> $surname,
               'email'=> $email,
               'dateofBirth'=> $dateofBirth,
               'password'=> $password,
               'created_byToken'=> null
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl))
            {
            echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $token=$decoded["token"];
               $message= $decoded["message"];
                  
               //! Tanım
               $registerCheck = $decoded["status"];
               $userToken = $decoded["token"];
                  
            }

            //kapat
            curl_close($curl);
            
            
            //! Login Durumuna yönlendirme
            if($registerCheck == 1) {
               
               $urlTo = 'user_admin_check?userToken='.$userToken;
               return redirect($urlTo)->with('userToken',$userToken);
               
               //return redirect()->route('login')->with('status',"succes")->with('msg',"Kullanıcı Oluşturuldu. Giriş Yapabilirsiniz");
            }
            else {
               return redirect()->route('register')->with('status',"error")->with('msg',$message);
            }
         }
         
      } 
      catch (\Throwable $th)
      {
         return view("error500");
      } 
   
  } //! Register Control Son

        
  //! Forgot
  public function Forgot_password()
  {
     //! Cookie Silme 
     setcookie("name",'',time()-86400); 
     setcookie("surname",'',time()-86400); 
     setcookie("userImageUrl",'',time()-86400); 
     
     setcookie("userCheck",'',time()-86400); 
     setcookie("userToken",'',time()-86400); 
     setcookie("categoryTitle",'',time()-86400); 
     setcookie("categoryToken",'',time()-86400); 
     
     setcookie("companyToken",'',time()-86400); 
     setcookie("companyId",'',time()-86400); 
     //! Cookie Silme Son 
   
     return view('forgot_password');
  }  //! Forgot Son
  
  
  //! Forgot Password - Control
  public function Forgot_passwordControl(Request $request)
  {
   
      try {
    
         //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $email= $request->email;
      
         //! Tanım
         $msgCheck=0;         
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/forgotPassword";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'email'=>  $email
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
         echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $msgCheck = $decoded["status"];
               
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($msgCheck == 1) {
            return redirect()->route('forgot_password')->with('status',"succes")->with('msg',"Email Gönderildi.");
         }
         else {
            return redirect()->route('forgot_password')->with('status',"error")->with('msg',"Email kontrol ediniz.");
         }
      
     } catch (\Throwable $th) {
         return redirect()->route('forgot_password')->with('status',"error")->with('msg',"Veri Tabanında Hata Oluştu.");
     }
      
  }    //! Forgot Password - Control Son
  
  
  //! Account - Check
  public function UserAdminCheck()
  {
   
     //! Cookie Silme 
     setcookie("userCheck",'',time()-86400); 
     setcookie("userToken",'',time()-86400); 
     
     return view('UserAdminCheck');
  } //! Account - Check Son
  
  //! Account - Check - Function
  public function UserAdminCheckControl(Request $request)
  {
      try {
    
         //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
      
         //! Tanım
         $mailCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/mail_send_confirmation_code";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'token'=>  $userToken
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);
          

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
           
            //! Tanım
            $mailCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Mail Gönderildi Durumuna yönlendirme
         if($mailCheck == 1) {
           
           $urlTo = 'user_admin_check?userToken='.$userToken;
           return redirect($urlTo)->with('status',"succes")->with('msg',"Mail Gönderildi.");
            
         }
         else {
           
           $urlTo = 'user_admin_check?userToken='.$userToken;
           return redirect($urlTo)->with('status',"error")->with('msg',"Mail Gönderilmedi");
         
         }
         
      
     } catch (\Throwable $th) {
          
         echo $th;
         die();
      
         return redirect()->route('user_admin_check')->with('status',"error")->with('msg',"Veri Tabanında Hata Oluştu.");
     }
    
  } //! Account - Check - Function Son
  
          
  //! Account - Check - Success
  public function UserAdminCheckSuccess()
  {
   
      try {
    
         //! Tanım
         $userCheck=0;
       
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/updateUrl";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> request('confirmation_code'),
            'isActive'=> 1,
            'updated_byToken'=> request('confirmation_code'),
            'adminCheck'=> 1
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);
          

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);

         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
          
            return view('UserAdminCheckSuccess');
            
         }
         else {
            return view('UserAdminCheckSuccess');
         }
         
      
     } catch (\Throwable $th) {
          
         echo $th;
         die();
      
         return view('UserAdminCheckSuccess');
     }
     
  } //! Account - Check - Success Son
  
  //! Reset Password
  public function ResetPassword()
  {
       //! Cookie Silme 
      setcookie("name",'',time()-86400); 
      setcookie("surname",'',time()-86400); 
      setcookie("userImageUrl",'',time()-86400); 
      
      setcookie("userCheck",'',time()-86400); 
      setcookie("userToken",'',time()-86400); 
      setcookie("categoryTitle",'',time()-86400); 
      setcookie("categoryToken",'',time()-86400); 
      
      setcookie("companyToken",'',time()-86400); 
      setcookie("companyId",'',time()-86400); 
     //! Cookie Silme Son 
     
     return view('resetPassword');
  } //! Reset Password Son
  
  //! Reset Password - Control
  public function ResetPasswordControl(Request $request)
  {
     try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         $pass= $request->pass;
         $repass= $request->repass;
         
         if($pass != $repass) {
            
            $urlTo = 'reset-password?confirmation_code='.$userToken;
            return redirect($urlTo)->with('status',"error")->with('msg',"Sifreler Farklıdır");
         }
         else {
            
        
            //! Tanım
            $userCheck=0;
         
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/user/updateUrl";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'token'=> $request->userToken,
               'updated_byToken'=> $request->userToken,
               'password'=> $request->pass
            );

            $data=http_build_query($data_array);
            
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);     
            
            //sorun varsa
            if($e=curl_error($curl))
            {
               echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);
            

               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
                  
               //! Tanım
               $userCheck = $decoded["status"];
               
            }

            //kapat
            curl_close($curl);
            
            
            //! Login Durumuna yönlendirme
            if($userCheck == 1) {
            
              $urlTo = 'reset-password?confirmation_code='.$userToken;
              return redirect($urlTo)->with('status',"succes")->with('msg',"Sifre Güncellendi");
               
            }
            else {
                $urlTo = 'reset-password?confirmation_code='.$userToken;
                return redirect($urlTo)->with('status',"error")->with('msg',"Sifre Güncellenmedi");
            }
         }
         
      
     } catch (\Throwable $th) {
          
         echo $th;
         die();
      
         return view('UserAdminCheckSuccess');
     }
  } //! Reset Password - Control  Son
  
          
  //! Index
  public function Index()
  {   
      try {
       
            //! Tanım
            $multiLang = "tr";
            $userCheck = 0;
            $userToken = "";
            $userID = "";
            $name = "Name";
            $surName = "surName";
            $email = "email";
            $userImageUrl = "userImageUrl";
            $companyToken = null;
            $categoryToken = null;
            $orderFindError = 0;
            
            //? Cookie Varmı
            if(isset($_COOKIE["userCheck"])) {
               
               $userCheck = 1;
               $userToken=$_COOKIE["userToken"];
               $userID=$_COOKIE["userID"];
               $name=$_COOKIE["name"];
               $surname=$_COOKIE["surname"];
            } 
             
            //! Varsa
            if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
            if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
             
            echo "</br>";


            if(session('status')=="succes") {          
               // echo "üye girişi oldu"; die();
               $userCheck = 1;
               $userToken = session('userToken');
               $userID = session('userID');
               
               //echo "userToken:"; echo $userToken; die();
               
               //! Cookie Ayarlama
               setcookie("userCheck",1,time()+86400); 
               setcookie("userToken",$userToken,time()+86400); 
               setcookie("userID",$userID,time()+86400); 

            }
            
            if($userCheck ) {
               
               //! User Verileri
               $userDB=[];
               $userRoleToken ="userRoleToken";
               $currentDB=[];
               $paymentAwaiting=0;
               $paymentDone=0;
               $totalPayment=0;
               $totalOrder=0;
               
               //Api Adresi 
               $api_url=env('YILDIRIMDEV_API_URL');
            
               //url
               $url= $api_url."/api/user/find_token";
               
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken'),
                  'token'=> $userToken
               );

               //print_r($data_array); die();
               
               $data=http_build_query($data_array);
               
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                  
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $userDB= $decoded["DB"];
                  
                  //print_r($userDB); die();
                  
                  //! Verileri Eşitleme
                  $name = $userDB["name"];
                  $surName = $userDB["surname"];
                  $email = $userDB["email"];
                  $userImageUrl = $userDB["userImageUrl"];
                  $userRoleToken = $userDB["userRoleToken"];
                  
                  //! Verileri Eşitleme
                  $companyToken = $userDB["companyToken"];
                  $categoryTitle = $userDB["categoryTitle"];
                  $categoryToken = $userDB["categoryToken"]; 
                 
                  
                  //! Return
                  //echo "userRoleToken: ";  echo $userRoleToken; echo "<br/>";   die();
                  
                  //! Cookie - User
                  setcookie("name",$name,time()+86400); 
                  setcookie("surname",$surName,time()+86400);
                  setcookie("userImageUrl",$userImageUrl,time()+86400);
                  setcookie("userRoleToken",$userDB["userRoleToken"],time()+86400);
                  
                   //! Cookie - Company
                  setcookie("categoryTitle",$userDB["categoryTitle"] ? $userDB["categoryTitle"] : "null",time()+86400);    
                  setcookie("categoryToken",$userDB["categoryToken"] ? $userDB["categoryToken"] : "null",time()+86400);  
                  
                  //! Cookie - Company
                  setcookie("companyId",$userDB["companyId"],time()+86400);    
                  setcookie("companyToken",$userDB["companyToken"],time()+86400); 
                  
                  //echo "companyToken:"; echo $userDB["companyToken"]; echo "<br/>"; die();
                  
               }

               //kapat
               curl_close($curl);
               
              if( $userRoleToken =="token") {
               
                //url
                  $url= $api_url."/api/order/find_group_serverToken";
                  
                  //Eklenecek Veriler
                  $data_array=array
                  (
                     'serverToken' => env('YILDIRIMDEV_ServerToken')
                  );
                  
                  $data=http_build_query($data_array);
                 
                  //aç    
                  $curl = curl_init();  

                  curl_setopt($curl, CURLOPT_URL, $url);
                  curl_setopt($curl, CURLOPT_POST, 1);
                  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                  
                  //veri okunuyor
                  $output = curl_exec($curl);
                  
                  //sorun varsa
                  if($e=curl_error($curl)) { echo $e; }
                  else 
                  {  
                     // Json verisine dönüştür
                     $decoded=json_decode($output,true);
                   
                     //! Verileri Okuma
                     $title=$decoded["title"];
                     $tablo=$decoded["table"];
                     $status=$decoded["status"];
                     $currentDB= $decoded["DB"];
                     
                     $paymentAwaiting=$decoded["paymentAwaiting"];
                     $paymentDone=$decoded["paymentDone"];
                     $totalPayment=$decoded["totalPayment"];
                     $totalOrder=$decoded["size"];
                     
                  }

                  //kapat
                  curl_close($curl);
               
               }
               else {
               
                  //url
                  $url= $api_url."/api/order/find_group_companyToken";
                  
                  //Eklenecek Veriler
                  $data_array=array
                  (
                     'serverToken' => env('YILDIRIMDEV_ServerToken'),
                     'companyToken' => $companyToken
                  );
                  
                  $data=http_build_query($data_array);
                  
                 
            
                  //aç    
                  $curl = curl_init();  

                  curl_setopt($curl, CURLOPT_URL, $url);
                  curl_setopt($curl, CURLOPT_POST, 1);
                  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                  
                  //veri okunuyor
                  $output = curl_exec($curl);
                  
                  //sorun varsa
                  if($e=curl_error($curl)) { echo $e; }
                  else 
                  {  
                     // Json verisine dönüştür
                     $decoded=json_decode($output,true);

                     //! Verileri Okuma
                     $title=$decoded["title"];
                     $tablo=$decoded["table"];
                     $status=$decoded["status"];
                     $currentDB= $decoded["DB"];
                     
                     $paymentAwaiting=$decoded["paymentAwaiting"];
                     $paymentDone=$decoded["paymentDone"];
                     $totalPayment=$decoded["totalPayment"];
                     $totalOrder=$decoded["size"];
                     
                  }

                  //kapat
                  curl_close($curl);
                  
               }
               
             
               
               //! Return
               $userDB["paymentAwaiting"] =  $paymentAwaiting;
               $userDB["paymentDone"] =  $paymentDone;
               $userDB["totalPayment"] =  $totalPayment;
               $userDB["totalOrder"] =  $totalOrder;
               $userDB["currentDB"] =  $currentDB;
         
               //! Return View
               if( $userRoleToken == "token") {  return view('indexAdmin',$userDB); }
               else if($categoryToken == null) { return view('errorCompany',$userDB); }
               else  { return view('index',$userDB); }
             
             
            }
            else {
               return redirect('login');
            }
         
      } catch (\Throwable $th) {
        
         throw $th;
         //return view('error500');
      }
      
  }  //! Index Son
  
            
  //! AccountSettings
  public function AccountSettings()
  {
      //! Tanım
      $userCheck = 0;
      $userToken = null;
      $categoryTitle=null;
      $categoryToken=null;
      $companyToken=null;
      
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userToken=$_COOKIE["userToken"];
         $userCheck = 1;
      }
      
            
      if($userCheck ) {
         
         //! User Verileri
         $userDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/find_token";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $userToken
         );
         
        
         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
           echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $userDB= $decoded["DB"];
            
            $companyToken = $userDB["companyToken"];
            setcookie("companyToken",$companyToken,time()+86400);   
            
            //echo "companyToken:"; echo $companyToken; die();
         }

         //kapat
         curl_close($curl);    
         
         
         //********  CategoryDB *****/
         
         //! CategoryDB
         $CategoryDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/category/find_serverToken";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken')
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
           echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $CategoryDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         //********* Company ***/
         //! CompanyDB
         $CompanyDB=[];
         
        
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/find_token";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token' => $userDB['companyToken']
         );

         $data=http_build_query($data_array);
         
         if($userDB['companyToken']) {  
         
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
         }
         
         //sorun varsa
         if($e=curl_error($curl))
         {
           echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $CompanyDB= $decoded["DB"];
           
            
            if($status == 1) {
               
               if($userDB['companyToken']) {  
               
                  //! Verileri Eşitleme
                  $categoryTitle = $CompanyDB["categoryTitle"];
                  $categoryToken = $CompanyDB["categoryToken"];
                  
                  //! Cookie
                  setcookie("categoryTitle",$categoryTitle,time()+86400); 
                  setcookie("categoryToken",$categoryToken,time()+86400);    
               
              }
              
               
            }
           
            
         }

         //kapat
         curl_close($curl);
         
         //********* Banka  */
         $BankDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/bank/find_serverToken";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken')
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
           echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $BankDB= $decoded["DB"];
         }

         //kapat
         curl_close($curl);  
         
                  
         //********* bankAccount  */
         $bankAccountDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/bankAccount/find_token";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token' => isset($userDB["bankAccountToken"][0]) ? $userDB["bankAccountToken"][0] : null
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
           echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $bankAccountDB= $decoded["DB"];
         }

         //kapat
         curl_close($curl);   
         
         
         //! Return
         $data = $userDB;
         $data['category'] = $CategoryDB;
         $data['company'] = $CompanyDB;
         $data['bank'] = $BankDB;
         $data['bankAccount'] = $bankAccountDB;
         
        
         return view('account_settings',$data);
      }
      else {
         return view('login');
      }
    
  } //! AccountSettings Son
  
  
  //! UserInfoSetting
  public function UserInfoSetting(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/user/updateUrl";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'name'=> $request->name,
         'surname'=> $request->surname,
         'gsm'=> $request->gsm,
         'dateofBirth'=> $request->dateofBirth,
         'country'=> $request->country,
         'city'=> $request->city,
         'updated_byToken'=> $request->token
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
         
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! UserInfoSetting Son
  
      
  //! UserPassSetting
  public function UserPassSetting(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/user/updatePassword";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'old_password'=> $request->old_pass,
         'new_password'=> $request->new_pass,
         'updated_byToken'=> $request->token
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
         
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! UserPassSetting Son
  
        
  //! User Company Update
  public function UserCompanyUpdate(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/company/update_user";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'categoryToken'=> $request->categoryToken,
         'categoryTitle'=> $request->categoryTitle,
         'titleofcompany'=> $request->titleofcompany,
         'taxAdministration'=> $request->taxAdministration,
         'taxNo'=> $request->taxNo,
         'mersisNo'=> $request->mersisNo,
         'phoneNumber'=> $request->phoneNumber,
         'emailAddress'=> $request->emailAddress,
         'companyAddress'=> $request->companyAddress,
         'billingAddress'=> $request->billingAddress,
         'webAddress'=> $request->webAddress,
         'updated_byToken'=> $request->updated_byToken
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! User Company Update Son
  
         
  //! User Company Add
  public function UserCompanyAdd(Request $request)
  {
      
      //! Status
      $general_status=0;
      $companyToken=null;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/company/add_user_update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'userToken'=> $request->userToken,
         'categoryToken'=> $request->categoryToken,
         'categoryTitle'=> $request->categoryTitle,
         'titleofcompany'=> $request->titleofcompany,
         'taxAdministration'=> $request->taxAdministration,
         'taxNo'=> $request->taxNo,
         'mersisNo'=> $request->mersisNo,
         'phoneNumber'=> $request->phoneNumber,
         'emailAddress'=> $request->emailAddress,
         'companyAddress'=> $request->companyAddress,
         'billingAddress'=> $request->billingAddress,
         'webAddress'=> $request->webAddress,
         'created_byToken'=> $request->created_byToken
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
      
         $general_status =$status;
         
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'companyToken' => $companyToken==null ? "null" : $companyToken,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! User Company Add Son
  
        
  //! User BankAccount Update
  public function UserBankAccountUpdate(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/bankAccount/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'bankId'=> $request->bankId,
         'bankToken'=> $request->bankToken,
         'bankTitle'=> $request->bankTitle,
         'bankAccountTitle'=> $request->bankAccountTitle,
         'branch'=> $request->branch,
         'nameSurname'=> $request->nameSurname,
         'accountNumber'=> $request->accountNumber,
         'ibanNo'=> $request->ibanNo,
         'updated_byToken'=> $request->updated_byToken
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
         
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! User BankAccount Update Son
  
           
  //! User BankAccount Add
  public function UserBankAccountAdd(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/bankAccount/add_user_update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'userToken'=> $request->userToken,
         'bankId'=> $request->bankId,
         'bankToken'=> $request->bankToken,
         'bankTitle'=> $request->bankTitle,
         'bankAccountTitle'=> $request->bankAccountTitle,
         'branch'=> $request->branch,
         'nameSurname'=> $request->nameSurname,
         'accountNumber'=> $request->accountNumber,
         'ibanNo'=> $request->ibanNo,
         'created_byToken'=> $request->created_byToken
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
         
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! User BankAccount Add Son
  
  //! **************** File Upload ****************
  
  //! Post - User File Upload
  public function UserFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/user/updateUrl";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->userToken,
            'updated_byToken'=> $request->userToken,
            'userImageUrl'=> url('upload/uploads/'.$fileName),
            'userImageUploadUrl'=> "upload/uploads/".$fileName
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - User File Upload Son
  
  
  //! Post - PersonalIdentity File Upload
  public function PersonalIdentityPhotoFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->companyToken,
            'updated_byToken'=> $request->userToken,
            'personalIdentityPhotoFileUrl'=> url('upload/uploads/'.$fileName),
            'personalIdentityPhotoFileCheck'=> "token5",
            'generalDocumentApproval'=> "token5"
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - PersonalIdentity File Upload Son
  
    
  //! Post - taxSheet File Upload
  public function taxSheetFileUploadControl(Request $request)
  {

      $request->validate([
         'file' => 'required',
      ]);
      
      $fileName = time().'.'.$request->file->extension();  
      
      //$file = $request->file('file');
      $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
      
      //! Tanım
      $uploadStatus = false;
      $userUpdateStatus = false;
      $userUpdateMsg = "";

      if($file_status) { 
         $uploadStatus = true;
         $userUpdateStatus = true;
         
         try {
      
            //Veri Okuma
            // [ Name] - değerlerine göre oku
            $token= $request->_token;
            $userToken= $request->userToken;
            
            //! Tanım
            $userCheck=0;
         
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/company/update";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'token'=> $request->companyToken,
               'updated_byToken'=> $request->userToken,
               'taxSheetFileUrl'=> url('upload/uploads/'.$fileName),
               'taxSheetCheck'=> "token5",
               'generalDocumentApproval'=> "token5"
            );

            $data=http_build_query($data_array);
            
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);     
            
            //sorun varsa
            if($e=curl_error($curl))
            {
               echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
                  
               //! Tanım
               $userCheck = $decoded["status"];
               
            }

            //kapat
            curl_close($curl);
            
            
            //! Login Durumuna yönlendirme
            if($userCheck == 1) {
            
               $userUpdateStatus = true;
               $userUpdateMsg = "Veri Güncellendi";
               
            }
            else {
                  $userUpdateStatus = false;
                  $userUpdateMsg = "Veri Güncellenemedi";
            }
            
            
         
         } catch (\Throwable $th) {
               
            $userUpdateStatus = false;
            $userUpdateMsg = $th;
            
            echo $th;
            die();
         
            //return view('UserAdminCheckSuccess');
         }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  }  //! Post - taxSheet File Upload Son
  
      
  //! Post - tradeRegistry File Upload
  public function tradeRegistryGazetteFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->companyToken,
            'updated_byToken'=> $request->userToken,
            'tradeRegistryGazetteFileUrl'=> url('upload/uploads/'.$fileName),
            'tradeRegistryGazetteCheck'=> "token5",
            'generalDocumentApproval'=> "token5"
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - tradeRegistry File Upload Son
  
  
  //! Post - circularOfSignature File Upload
  public function circularOfSignatureFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->companyToken,
            'updated_byToken'=> $request->userToken,
            'circularOfSignatureFileUrl'=> url('upload/uploads/'.$fileName),
            'circularOfSignatureFileCheck'=> "token5",
            'generalDocumentApproval'=> "token5"
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - circularOfSignature File Upload Son
  
  
  
  //! Post - chamberOfCommerceRegistration File Upload
  public function chamberOfCommerceRegistrationFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->companyToken,
            'updated_byToken'=> $request->userToken,
            'chamberOfCommerceRegistrationFileUrl'=> url('upload/uploads/'.$fileName),
            'chamberOfCommerceRegistrationCheck'=> "token5",
            'generalDocumentApproval'=> "token5"
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - chamberOfCommerceRegistration File Upload Son
  
  
  //! Post - serviceContract File Upload
  public function serviceContractFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;
    $userUpdateStatus = false;
    $userUpdateMsg = "";

    if($file_status) { 
      $uploadStatus = true;
      $userUpdateStatus = true;
      
      try {
    
          //Veri Okuma
         // [ Name] - değerlerine göre oku
         $token= $request->_token;
         $userToken= $request->userToken;
         
         //! Tanım
         $userCheck=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/company/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->companyToken,
            'updated_byToken'=> $request->userToken,
            'serviceContractFileUrl'=> url('upload/uploads/'.$fileName),
            'serviceContractCheck'=> "token5",
            'generalDocumentApproval'=> "token5"
         );

         $data=http_build_query($data_array);
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);     
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
               
            //! Tanım
            $userCheck = $decoded["status"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! Login Durumuna yönlendirme
         if($userCheck == 1) {
         
            $userUpdateStatus = true;
            $userUpdateMsg = "Veri Güncellendi";
            
         }
         else {
               $userUpdateStatus = false;
               $userUpdateMsg = "Veri Güncellenemedi";
         }
         
         
      
      } catch (\Throwable $th) {
            
         $userUpdateStatus = false;
         $userUpdateMsg = $th;
         
         echo $th;
         die();
      
         //return view('UserAdminCheckSuccess');
      }
      
    }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'companyToken' =>  $request->companyToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads'),
        'userUpdateStatus' => $userUpdateStatus,
        'userUpdateMsg' => $userUpdateMsg
    );

    return response()->json($response);

  } //! Post - serviceContract File Upload Son
  

   //! **************** Kullanıcı Listesi ****************

   //! Kullanıcı Listesi
   public function userList()
   {
      
      try {
        
           //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            $apiRoleDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
       
            //url
            $url= $api_url."/api/user/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
               
            }

            //kapat
            curl_close($curl);
            
            //! **** Kullanıcı Yetkisi
           
            //url
            $url= $api_url."/api/userRole/all";
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            
            // SSL important
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 0);

            
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiRoleDB= $decoded["DB"];
               
            }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            
            //! Data
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
            
            $DB["apiRoleDB"] = $apiRoleDB;
            
       
            return view('userList',$DB);
         }
         else {
            return view('login');
         }   
         
      } catch (\Throwable $th) {
         //throw $th;
         
         return view('error500');
         
      }
       
      
   } //! Kullanıcı Listesi Son

          
  //! Kullanıcı Listesi Active
  public function userUpdate(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/user/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'isActive'=> $request->active == "true" ? false: true,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  } //! Kullanıcı Listesi Active  Son
  
  
          
  //! Kullanıcı Yetkisi Güncelle
  public function userUpdateRole(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/user/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'userRoleToken'=> $request->userRoleToken ,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'token' => $request->token,
          'userRoleToken' => $request->userRoleToken,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  }   //! Kullanıcı Yetkisi Güncelle Son
   
      
   //! **************** Firma Listesi ****************
  
   //! Firma Listesi
   public function companyList()
   {
      try {
          //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
             
            //url
            $url= $api_url."/api/company/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
               
            }

            //kapat
            curl_close($curl);
            
            // echo $apiDB[1]["bankAccount"] ? $apiDB[1]["bankAccount"] : null ;
            // die();
         
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
        
            
            //! Data
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
            
            return view('companyList',$DB);
         }
         else {
            return view('login');
         }   
      } catch (\Throwable $th) {
         //throw $th;
         
         return view('error500');
      }
      
      
   } //! Firma Listesi Son
   
             
  //! Firma Güncelleme
  public function companyUpdate(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/company/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'personalIdentityPhotoFileCheck'=> $request->personalIdentityPhotoFileUrlSwitch  ? $request->personalIdentityPhotoFileUrlSwitch =="true" ? "token6" : "token5" : null,
         'taxSheetCheck'=> $request->taxSheetFileUrlSwitch  ? $request->taxSheetFileUrlSwitch =="true" ? "token6" : "token5" :null,
         'circularOfSignatureFileCheck'=> $request->circularOfSignatureFileUrlSwitch  ? $request->circularOfSignatureFileUrlSwitch =="true" ? "token6" : "token5" :null,
         'tradeRegistryGazetteCheck'=> $request->tradeRegistryGazetteFileUrlSwitch  ? $request->tradeRegistryGazetteFileUrlSwitch =="true" ? "token6" : "token5" :null,
         'chamberOfCommerceRegistrationCheck'=> $request->chamberOfCommerceRegistrationFileUrlSwitch  ? $request->chamberOfCommerceRegistrationFileUrlSwitch =="true" ? "token6" : "token5" :null,
         'serviceContractCheck'=> $request->serviceContractFileUrlSwitch ? $request->serviceContractFileUrlSwitch =="true" ? "token6" : "token5" :null,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
         'status' => $general_status,
         'token'=> $request->token,
         'data_array'=> $data_array,
         'created_byToken'=> $_COOKIE["userToken"],
         'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  } //! Firma Güncelleme Son
  
               
  //! Firma Güncelleme Active
  public function companyUpdateActive(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/company/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'isActive'=> $request->active == "true" ? false: true,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  } //! Firma Güncelleme Active  Son
  
                 
  //! Firma Güncelleme Payment
  public function companyUpdatePayment(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/company/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'paymentDate'=> (int)$request->paymentDate,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'paymentDate'=> (int)$request->paymentDate,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  } //! Firma Güncelleme Payment  Son
  
  
  //! **************** Ürün ****************
  
  //Ürün Listesi
  public function ProductList()
  {
   
      //! Tanım
      $multiLang = "tr";
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $companyToken=null;
      $categoryTitle=null;
      $categoryToken=null;

   
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
      }
                  
      //? Cookie Varmı
      if(isset($_COOKIE["multiLang"])) { $multiLang=$_COOKIE["multiLang"];  } 
      
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"];  } 
      if(isset($_COOKIE["categoryTitle"])) { $categoryTitle=$_COOKIE["categoryTitle"];  } 
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"];  } 
      
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         $productStatus = 0;
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
         $data_array = array();
   
         
         if($_COOKIE["userRoleToken"] == "token") {
            
            //url
            $url= $api_url."/api/product/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );
               
         }
         else {
           
            //url
            $url= $api_url."/api/product/find_company";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'companyToken'=> $companyToken
            );               
            
         }
         
         
         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $productStatus=$decoded["status"];
            $apiDB= $decoded["DB"];
         }

         //kapat
         curl_close($curl);
         
         //! Verileri Seçiyor
         $parameter_page = request('page') ? request('page') : 1;
         $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
         $newDB = [];
         $newDBCount=0;
         
         
         
         //! ApiDb
         $apiDBCount =$productStatus == 1 ?  count($apiDB)  : 0;
         $apiDBRowCount = $productStatus == 1 ?  ceil(count($apiDB) / $parameter_rowcount) : 0;
          
         $pageindex =$parameter_rowcount*($parameter_page-1);
         $pagelast =$parameter_rowcount*$parameter_page;
         
         $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
          
         for ($i=$pageindex; $i <$pagelast; $i++) { 
            $newDB[$newDBCount] = $apiDB[$i];
            $newDBCount++;
         }
         
         //! Verileri Seçiyor Son
         
         //! Return
         $DB["multiLang"] = $multiLang;
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
         $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["categoryToken"] = $categoryToken;
         $DB["apiDB"] = $newDB;
         $DB["apiDBCount"] = $apiDBCount;
         $DB["apiDBRowCount"] = $apiDBRowCount;
         $DB["parameter_page"] = $parameter_page;
         $DB["parameter_rowcount"] = $parameter_rowcount;
         
         //echo "YILDIRIMDEV_ServerToken: "; echo env('YILDIRIMDEV_ServerToken'); echo "<br/>";
         //echo "companyToken: "; echo $_COOKIE["companyToken"]; die();
         //echo json_encode($apiDB[0]["id"]); die();
         //echo $apiDB[0]["productName"]; die();
         //print_r($apiDB); die();
         
         if( $_COOKIE["userRoleToken"] == "token") {  return view('productList',$DB); }
         else if( $companyToken == null) { return view('errorCompany',$DB); }
         else  { return view('productList',$DB); }
         
      }
      else {
         return view('login');
      }   
     
  } //! Ürün Listeleme Son
  
  
  //Ürün Ekleme - Step1
  public function ProductAdd()
  {
   
      //! Tanım
      $multiLang = "tr";
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $companyToken=null;
      $categoryTitle=null;
      $categoryToken=null;
     
      
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      }
      
      //? Cookie Varmı
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"];  } 
      if(isset($_COOKIE["categoryTitle"])) { $categoryTitle=$_COOKIE["categoryTitle"];  } 
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"];  } 
      
      
      if($userCheck ) {
         
         
         //********  BrandDB *****/
          
         //! User Verileri
         $BrandDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/all";
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $BrandDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         //********  BrandDB Son *****/
         
                 
         //! Return  
         $data["name"] = $name;
         $data["surname"] = $surname;
         $data["userImageUrl"] = $userImageUrl;
         $data["userRoleToken"] = $_COOKIE["userRoleToken"];
         
         $data["companyToken"] = $companyToken;
         
         $data["categoryTitle"] = $categoryTitle;
         $data["categoryToken"] = $categoryToken;
         
         $data["brandDB"] = $BrandDB;
         
         //echo "companyToken: "; echo  $companyToken; die();
         
         if( $_COOKIE["userRoleToken"] == "token") {  return view('productAdd',$data); }
         else if($companyToken == null) { return view('errorCompany',$data); }
         else  { return view('productAdd',$data); }
     
      }else {  
         return view('admin.login');
      } 
     
  } //! Ürün Ekleme - Step1  Son
  
    
  //! Ürün Ekleme - Step2
  public function ProductAddStepTwo()
  {
   
      //! temp_id
      $temp_id = request('temp_id');
      
      //! Tanım
      $multiLang = "tr";
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $categoryTitle="categoryTitle";
      $categoryToken="categoryToken";
      $userImageUrl = "userImageUrl";
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
         $categoryTitle=$_COOKIE["categoryTitle"];
         $categoryToken=$_COOKIE["categoryToken"];
      }
      
      if($userCheck ) {
         
                 
         //! Return  
         $data["temp_id"] = $temp_id;
          
         $data["name"] = $name;
         $data["surname"] = $surname;
         $data["userImageUrl"] = $userImageUrl;
         $data["userRoleToken"] = $_COOKIE["userRoleToken"];
         
         $data["categoryTitle"] = $categoryTitle;
         $data["categoryToken"] = $categoryToken;
         
         
         return view('productAdd_StepTwo',$data);
     
      }
      else {  
         return view('admin.login');
      } 
     
  } //! Ürün Ekleme - Step2 Son
  
       
  //Ürün Ekleme - Step3
  public function ProductAddStepThree()
  {
   
      //! Tanım
      $multiLang = "tr";
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $categoryTitle="categoryTitle";
      $categoryToken="categoryToken";
      $userImageUrl = "userImageUrl";
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
         $categoryTitle=$_COOKIE["categoryTitle"];
         $categoryToken=$_COOKIE["categoryToken"];
      }
      
      if($userCheck ) {
         
                 
         //! Return  
         $data["name"] = $name;
         $data["surname"] = $surname;
         $data["userImageUrl"] = $userImageUrl;
         $data["userRoleToken"] = $_COOKIE["userRoleToken"];
         
         $data["categoryTitle"] = $categoryTitle;
         $data["categoryToken"] = $categoryToken;
         
         return view('productAdd_StepThree',$data);
     
      }else {  
         return view('admin.login');
      } 
     
  } //Ürün Ekleme - Step3 Son
   
   
  //! Ürün Ekleme - Post
  public function ProductAddPost(Request $request)
  {
      // //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/add";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         
         'companyToken'=> $request->companyToken,
         'categoryToken'=> $request->categoryToken,
         'categoryTitle'=> $request->categoryTitle,
         'siteName'=> "bex360",
         'brandToken'=> $request->brandToken,
         'brandTitle'=> $request->brandTitle,
         
         'productImageUrl'=> $request->productImageUrl,
         
         'productOtherImageUrl1'=> $request->productOtherImageUrl1,
         'productOtherImageUrl2'=> $request->productOtherImageUrl2,
         'productOtherImageUrl3'=> $request->productOtherImageUrl3,
         'productOtherImageUrl4'=> $request->productOtherImageUrl4,
         'productOtherImageUrl5'=> $request->productOtherImageUrl5,
         'productOtherImageUrl6'=> $request->productOtherImageUrl6,
         
         'productName'=> $request->productName,
         'productCode'=> $request->productCode,
         'productPrice'=> $request->productPrice,
         'productPriceType'=> $request->productPriceType,
         'productStock'=> $request->productStock,
         'productStockTitle'=> $request->productStockTitle,
     
         'description'=> $request->description,
         'qcodeFileUrl'=> $request->qcodeFileUrl,
         
         'isActive' => $request->productStock == "0" ? false : true,
         'created_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'productImageUrl' => $request->productImageUrl,
          'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi',
          
      );

      return response()->json($response);
  } //! Ürün Ekleme - Post Son
  
   //! Ürün Ekleme - Post - Multi
  public function ProductAddPostMulti(Request $request)
  {
      // //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/add/multi";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'companyToken' => $_COOKIE["companyToken"],
         'categoryToken' => $_COOKIE["categoryToken"],
         
         'addDataList' => json_encode($request->addDataList),
         
         'created_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'productImageUrl' => $request->productImageUrl,
          'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi',
          
      );

      return response()->json($response);
  } //! Ürün Ekleme - Post - Multi - Son
   
     
  //! Post - User File Upload
  public function ProductFileUploadControl(Request $request)
  {

    $request->validate([
        'file' => 'required',
    ]);
    
    $fileName = time().'.'.$request->file->extension();  
    
    //$file = $request->file('file');
    $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
    
    //! Tanım
    $uploadStatus = false;

    if($file_status) {  $uploadStatus = true; }

    
    $response = array(
        'userToken' =>  $request->userToken,
        'file_upload_status'=>$uploadStatus,
        'file_path'=>url('upload/uploads/'.$fileName),
        'file_name'=>$fileName,
        'file_originName'=>request()->file->getClientOriginalName(),
        'file_ext'=>request()->file->getClientOriginalExtension(),
        'file_url'=>"upload/uploads/".$fileName,
        'file_url_public'=>public_path('upload/uploads')
    );

    return response()->json($response);

  }  //! Post - User File Upload Son
  
  //Ürün  Engrasyon ile Ekleme
  public function ProductIntegration()
  {
   
       
      //! Tanım
      $multiLang = "tr";
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $companyToken=null;
      $categoryTitle=null;
      $categoryToken=null;
      
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      }
      
           
       //? Cookie Varmı
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"];  } 
      if(isset($_COOKIE["categoryTitle"])) { $categoryTitle=$_COOKIE["categoryTitle"];  } 
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"];  }     
      
      if($userCheck ) {
         
                 
         //! Return  
         $data["name"] = $name;
         $data["surname"] = $surname;
         $data["userImageUrl"] = $userImageUrl;
         $data["userRoleToken"] = $_COOKIE["userRoleToken"];
         
         
         $data["companyToken"] = $companyToken;
         
         $data["categoryTitle"] = $categoryTitle;
         $data["categoryToken"] = $categoryToken;
         
         if( $_COOKIE["userRoleToken"] == "token") {  return view('productAdd',$data); }
         else if($companyToken == null) { return view('errorCompany',$data); }
         else  { return view('productIntegration',$data); }
     
      }else {  
         return view('admin.login');
      } 
     
  }  //Ürün  Engrasyon ile Ekleme Son
  
     
  //! Ürün Silme - Post
  public function ProductDelete(Request $request)
  {
       //! Status
       $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/delete_update/".$request->id;
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'deleted_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "id" => $request->id,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
          
      );

      return response()->json($response);
  } //! Ürün Silme - Post Son
  
       
  //! Ürün Güncelleme - Post
  public function ProductUpdateActive(Request $request)
  {
       //! Status
       $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'isActive'=> $request->active == "true" ? false: true,
         'isDeleted'=> $request->active == "true" ? true: false,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "token" => $request->token,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Ürün Güncelleme - Post Son
  
    
  //! Ürün Görüntüleme
  public function ProductView($id)
  {
   
         //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $categoryTitle=null;
      $categoryToken=null;
      
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      } 
      
       //? Cookie Varmı
      if(isset($_COOKIE["categoryTitle"])) { $categoryTitle=$_COOKIE["categoryTitle"];  } 
      if(isset($_COOKIE["categoryToken"])) { $categoryTitle=$_COOKIE["categoryToken"];  } 

      if( $_COOKIE["userRoleToken"] != "token" &&  !isset($_COOKIE["categoryTitle"])) { echo "Firma Kategorisini ekleme yapınuz."; die();  } 
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/product/".$id;
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! DB Bilgisi
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
         $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB"] = $apiDB;
         
         $DB["categoryTitle"] = $categoryTitle;
         $DB["categoryToken"] = $categoryToken;
         
         return view('productView',$DB);
      }
      else {
         return view('login');
      }  
   
  } //! Ürün Görüntüleme Son
  
        
  //! Ürün Güncelleme
  public function ProductEdit($id)
  {
      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $companyToken=null;
      $categoryTitle=null;
      $categoryToken=null;
    
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
         
         // $categoryTitle=$_COOKIE["categoryTitle"];
         // $categoryToken=$_COOKIE["categoryToken"];
      } 
      
       //? Cookie Varmı
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"];  } 
      if(isset($_COOKIE["categoryTitle"])) { $categoryTitle=$_COOKIE["categoryTitle"];  } 
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"];  } 
      if(!isset($_COOKIE["categoryTitle"])) { echo "Firma Kategorisini ekleme yapınuz."; die();  } 
      
      //echo "categoryToken: "; echo $categoryToken; die();
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/product/".$id;
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
                  
         //********  BrandDB *****/
          
         //! User Verileri
         $BrandDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/all";
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $BrandDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         //********  BrandDB Son *****/
         
         //! DB Bilgisi
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB"] = $apiDB;
         
         $DB["categoryTitle"] = $categoryTitle;
         $DB["categoryToken"] = $categoryToken;
         
         $DB["companyToken"] = $companyToken;
         
         $DB["brandDB"] = $BrandDB;
         
         //echo "companyToken: "; echo $companyToken; die();
         
         return view('productEdit',$DB);
      }
      else {
         return view('login');
      }  
   
  } //! Ürün Güncelleme Son
   
          
  //! Ürün Güncelleme - Post
  public function ProductUpdateStep1(Request $request)
  {
       //! Status
       $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'companyToken'=> $request->companyToken,
         'categoryToken'=> $request->categoryToken,
         'brandTitle'=> $request->brandTitle,
         'brandToken'=> $request->brandToken,
         'productName'=> $request->productName,
         'productCode'=> $request->productCode,
         'productPrice'=> $request->productPrice,
         'productPriceType'=> $request->productPriceType,
         'productStock'=> $request->productStock,
         'productStockTitle'=> $request->productStockTitle,
         'description'=> $request->description,
         'isActive' => $request->productStock == "0" ? false : true,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "token" => $request->token,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Ürün Güncelleme - Post Son
   
          
  //! Ürün Güncelleme - Step2
  public function ProductEditStep2($id)
  {
      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $categoryTitle="categoryTitle";
      $categoryToken="categoryToken";
      $userImageUrl = "userImageUrl";
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
         $categoryTitle=$_COOKIE["categoryTitle"];
         $categoryToken=$_COOKIE["categoryToken"];
      } 
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/product/".$id;
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         
         //! DB Bilgisi
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
         $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB"] = $apiDB;
         
         $DB["categoryTitle"] = $categoryTitle;
         $DB["categoryToken"] = $categoryToken;
         
         return view('productEditStep2',$DB);
      }
      else {
         return view('login');
      }  
   
  } //! Ürün Güncelleme Step2 Son
   
             
  //! Ürün Güncelleme - Post
  public function ProductUpdateStep2(Request $request)
  {
       //! Status
       $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/product/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'productImageUrl'=> $request->productImageUrl ? $request->productImageUrl : "",
         'productOtherImageUrl1'=> $request->productOtherImageUrl1 ? $request->productOtherImageUrl1 : "" ,   
         'productOtherImageUrl2'=> $request->productOtherImageUrl2 ? $request->productOtherImageUrl2  : "" ,   
         'productOtherImageUrl3'=> $request->productOtherImageUrl3 ? $request->productOtherImageUrl3  : "" ,   
         'productOtherImageUrl4'=> $request->productOtherImageUrl4 ? $request->productOtherImageUrl4  : "" ,   
         'productOtherImageUrl5'=> $request->productOtherImageUrl5 ? $request->productOtherImageUrl5  : "" ,   
         'productOtherImageUrl6'=> $request->productOtherImageUrl6 ? $request->productOtherImageUrl6  : "" ,   
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "token" => $request->token,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Ürün Güncelleme - Post Son
   
   
          
  //Ürün Güncelleme Step3
  public function ProductEditStep3($id)
  {
      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $categoryTitle="categoryTitle";
      $categoryToken="categoryToken";
      $userImageUrl = "userImageUrl";
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
         
         $categoryTitle=$_COOKIE["categoryTitle"];
         $categoryToken=$_COOKIE["categoryToken"];
      } 
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/product/".$id;
         
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         
         // SSL important
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 0);

         
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl)) { echo $e; }
         else 
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            //! Verileri Okuma
            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB= $decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
                  
      
         
         //! DB Bilgisi
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB"] = $apiDB;
         
         $DB["categoryTitle"] = $categoryTitle;
         $DB["categoryToken"] = $categoryToken;
         
         
         return view('productEditStep3',$DB);
      }
      else {
         return view('login');
      }  
   
  } //Ürün Güncelleme  Step3 Son
   
  
  //! **************** Sipariş ****************

   //Sipariş Listesi
   public function ordersList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $userImageUrl = "userImageUrl";
         $categoryTitle=null;
         $categoryToken=null;
         $companyToken = null;
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
          //! Varsa
         if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
         if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
           
            if($_COOKIE["userRoleToken"] == "token") {
            
               $url= $api_url."/api/order/find_group_serverToken";
                
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken')
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  //print_r($apiDB); die();
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  $totalOrder=$decoded["totalOrder"];
                  
               }

               //kapat
               curl_close($curl);
              
            }
            else {
            
               //url
               $url= $api_url."/api/order/find_group_companyToken";
               
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken'),
                  'companyToken'=> $companyToken
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  $totalOrder=$decoded["totalOrder"];
                  
               }

               //kapat
               curl_close($curl);
               
            }
         
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son

             //********  CargoCompanyDB *****/
            
            //! CargoCompany
            $CargoCompany=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/cargoCompany/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl))
            {
              echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $CargoCompany= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
            
            $DB["CargoCompany"] = $CargoCompany;
            
            
            //! Return View
            if( $_COOKIE["userRoleToken"] == "token") {  return view('ordersList',$DB); }
            else if($companyToken == null) { return view('errorCompany',$DB); }
            else  { return view('ordersList',$DB); }
         

            
         }
         else {
            return view('login');
         }   
      
   } //! Sipariş Listeleme
   

   //! Sipariş  Update - Product
   public function ordersUpdateProduct(Request $request)
   {
      
      //! Status
      $general_status=0;

      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');

      //url
      $url= $api_url."/api/order/updated_product";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'products'=> json_encode($request->products),
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e; die();
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);
         
         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
         'status' => $general_status,
         'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
   } //! Sipariş  Update - Product Son
   
   
   //! Sipariş  Update - Cargo
   public function ordersUpdateCargo(Request $request)
   {
      
      //! Status
      $general_status=0;

      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');

      //url
      $url= $api_url."/api/order/updated_cargo";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'companyToken'=> $request->companyToken,
         'cargoStatus'=> $request->cargoStatus,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e; die();
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);
         
         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
         'status' => $general_status,
         'token'=> $request->token,
         'url' => $api_url."/api/order/updated_cargo",
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'companyToken'=> $request->companyToken,
         'cargoStatus'=> $request->cargoStatus,
         'updated_byToken'=> $_COOKIE["userToken"],
         'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
   } //! Sipariş  Update - Product Son
   
   
      
   //! Sipariş  Update - Cargo Tracking Code
   public function ordersUpdateCargoTrackingCode(Request $request)
   {
      
      //! Status
      $general_status=0;

      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');

      //url
      $url= $api_url."/api/order/updated_cargo/trackingCode";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'companyToken'=> $request->companyToken,
         'cargoStatus'=> $request->cargoStatus,
         'cargoCompanyToken'=> $request->cargoCompanyToken,
         'cargoTrackingCode'=> $request->cargoTrackingCode,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e; die();
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);
         
         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
         'status' => $general_status,
         'token'=> $request->token,
         'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
   } //! Sipariş  Update - Product Son
   
                     
   //! Sipariş  Arama
   public function ordersSearchCompany(Request $request)
   {
      
      //! Status
      $general_status=0;
      
      //! Veriler
      $apiDB=[];

      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');

      //url
      $url= $api_url."/api/order/find_group_token_companyToken";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'token'=> $request->token,
         'companyToken'=> $request->companyToken
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         $apiDB=$decoded["DB"];
         
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
            'status' => $general_status,
            'apiDB' => $apiDB,
            'msg' => $general_status == 0 ? 'Veri Bulunamadı' : 'Veri Bulundu',
            
      );

      return response()->json($response);
   } //! Sipariş  Arama Son


   //! **************** Sipariş Son ****************
     
  //! **************** Kargo ****************

   //! Kargo Listesi
   public function cargoList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $userImageUrl = "userImageUrl";
         $categoryTitle=null;
         $categoryToken=null;
         $companyToken = null;
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         }
         
         //! Varsa
         if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
         if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }

         
         if($userCheck ) {
            
              
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');

            if($_COOKIE["userRoleToken"] == "token") {
            
               $url= $api_url."/api/order/find_group_serverToken";
                
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken')
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  //print_r($apiDB); die();
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  
               }

               //kapat
               curl_close($curl);
              
            }
            else {
            
               //url
               $url= $api_url."/api/order/find_group_companyToken";
               
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken'),
                  'companyToken'=> $companyToken
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  
               }

               //kapat
               curl_close($curl);
               
            }
            
            //print_r( $apiDB[0]["cargo"]["cargoStatusToken"]);
            
            $apiDB_New = [];
            $apiDB_NewCount =0;
            
            for ($i=0; $i < count($apiDB) ; $i++) { 
               if($apiDB[$i]["cargo"]["cargoStatusToken"] == "token14" || $apiDB[$i]["cargo"]["cargoStatusToken"] == "token15" ) {
                  $apiDB_New[$apiDB_NewCount] = $apiDB[$i]; //! Yeni verileri güncellendi
                  $apiDB_NewCount ++; //! Sayaç artiyor
               }
            }
            
        
            //! Api 
            $apiDB =  $apiDB_New;
            
            
            
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son

             //********  CategoryDB *****/
            
            //! CargoCompany
            $CargoCompany=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/cargoCompany/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl))
            {
              echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $CargoCompany= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
           
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
            
            $DB["CargoCompany"] = $CargoCompany;
            
    
            //! Return View
            if( $_COOKIE["userRoleToken"] == "token") {  return view('cargoList',$DB); }
            else if($companyToken == null) { return view('errorCompany',$DB); }
            else  { return view('cargoList',$DB); }
         
            
         }
         else {
            return view('login');
         }   
      
   } //! Kargo Listeleme
   
   
   //! **************** Finans ****************
   
   
   //! Cari Hesap Listesi
   public function currentList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $userImageUrl = "userImageUrl";
         $categoryTitle=null;
         $categoryToken=null;
         $companyToken = null;
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         //! Varsa
         if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
         if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            $paymentAwaiting = 0;
            $paymentDone = 0;
            $totalPayment = 0;
            $totalOrder = 0;
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');

            if($_COOKIE["userRoleToken"] == "token") {
            
               $url= $api_url."/api/order/find_group_serverToken";
                
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken')
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  //print_r($apiDB); die();
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  $totalOrder=$decoded["totalOrder"];
                  
               }

               //kapat
               curl_close($curl);
              
            }
            else {
            
               //url
               $url= $api_url."/api/order/find_group_companyToken";
               
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken'),
                  'companyToken'=> $companyToken
               );
               
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
                  
                  $paymentAwaiting=$decoded["paymentAwaiting"];
                  $paymentDone=$decoded["paymentDone"];
                  $totalPayment=$decoded["totalPayment"];
                  $totalOrder=$decoded["totalOrder"];
                  
               }

               //kapat
               curl_close($curl);
               
            }
         
            $apiDB_New = [];
            $apiDB_NewCount =0;
            
            for ($i=0; $i < count($apiDB) ; $i++) { 
               if($apiDB[$i]["total"]["paymentStatusToken"] == "token16" || $apiDB[$i]["total"]["paymentStatusToken"] == "token17" || $apiDB[$i]["total"]["paymentStatusToken"] == "token23" ) {
                  $apiDB_New[$apiDB_NewCount] = $apiDB[$i]; //! Yeni verileri güncellendi
                  $apiDB_NewCount ++; //! Sayaç artiyor
               }
            }
            
        
            //! Api 
            $apiDB =  $apiDB_New;
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son

            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
            
            $DB["paymentAwaiting"] = $paymentAwaiting;
            $DB["paymentDone"] = $paymentDone;
            $DB["totalPayment"] = $totalPayment;
            $DB["totalOrder"] = $totalOrder;
            
             
            //! Return View
            if( $_COOKIE["userRoleToken"] == "token") {  return view('currentList',$DB); }
            else if($companyToken == null) { return view('errorCompany',$DB); }
            else  { return view('currentList',$DB); }
            
         }
         else {
            return view('login');
         }   
      
   } //! Cari Hesap  Listeleme Son
   
      
   //! Cari Hesap - Fatura Yükleme
   public function invoiceFileUploadControl(Request $request)
   {
       $request->validate([
         'file' => 'required',
      ]);
      
      $fileName = time().'.'.$request->file->extension();  
      
      //$file = $request->file('file');
      $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
      
      //! Tanım
      $uploadStatus = false;
      $apiUpdateStatus = false;
      $apiUpdateMsg = "";

      if($file_status) { 
         $uploadStatus = true;
         $apiUpdateStatus = true;
         
         try {
      
            //Veri Okuma
            // [ Name] - değerlerine göre oku
            $token= $request->_token;
            $userToken= $request->userToken;
            
            //! Tanım
            $apiCheck=0;
         
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/order/updated_current_doc/invoiceFile";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'updated_byToken'=> $_COOKIE["userToken"],
               'token'=> $request->apiToken,
               'companyToken'=> $request->companyToken,
               'invoiceFileUrl'=> url('upload/uploads/'.$fileName)
            );

            $data=http_build_query($data_array);
            
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);     
            
            //sorun varsa
            if($e=curl_error($curl))
            {
               echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               // $title=$decoded["title"];
               // $tablo=$decoded["table"];
               $status=$decoded["status"];
                  
               //! Tanım
               $apiCheck = $decoded["status"];
               
            }

            //kapat
            curl_close($curl);
            
            
            //! Login Durumuna yönlendirme
            if($apiCheck == 1) {
            
               $apiUpdateStatus = true;
               $apiUpdateMsg = "Veri Güncellendi";
               
            }
            else {
                  $apiUpdateStatus = false;
                  $apiUpdateMsg = "Veri Güncellenemedi";
            }
         
         } catch (\Throwable $th) {
               
            $apiUpdateStatus = false;
            $apiUpdateMsg = $th;
            
            echo $th;
            die();
         
            //return view('UserAdminCheckSuccess');
         }
         
      }
      
      $response = array(
         'apiToken' =>  $request->apiToken,
         'companyToken' =>  $request->companyToken,
         'file_upload_status'=>$uploadStatus,
         'file_path'=>url('upload/uploads/'.$fileName),
         'file_name'=>$fileName,
         'file_originName'=>request()->file->getClientOriginalName(),
         'file_ext'=>request()->file->getClientOriginalExtension(),
         'file_url'=>"upload/uploads/".$fileName,
         'file_url_public'=>public_path('upload/uploads'),
         'apiUpdateStatus' => $apiUpdateStatus,
         'apiUpdateMsg' => $apiUpdateMsg
      );

      return response()->json($response);

   } //! Cari Hesap - Fatura Yükleme Son
   
         
   //! Cari Hesap - Dekont Yükleme
   public function receiptFileUploadControl(Request $request)
   {

      $request->validate([
         'file' => 'required',
      ]);
      
      $fileName = time().'.'.$request->file->extension();  
      
      //$file = $request->file('file');
      $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
      
      //! Tanım
      $uploadStatus = false;
      $apiUpdateStatus = false;
      $apiUpdateMsg = "";

      if($file_status) { 
         $uploadStatus = true;
         $apiUpdateStatus = true;
         
         try {
      
            //Veri Okuma
            // [ Name] - değerlerine göre oku
            $token= $request->_token;
            $userToken= $request->userToken;
            
            //! Tanım
            $apiCheck=0;
         
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
           //url
            $url= $api_url."/api/order/updated_current_doc/receiptFile";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'updated_byToken'=> $_COOKIE["userToken"],
               'token'=> $request->apiToken,
               'companyToken'=> $request->companyToken,
               'receiptFileUrl'=> url('upload/uploads/'.$fileName)
            );

            $data=http_build_query($data_array);
            
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);     
            
            //sorun varsa
            if($e=curl_error($curl))
            {
               echo $e;
            }
            else
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               // $title=$decoded["title"];
               // $tablo=$decoded["table"];
               $status=$decoded["status"];
                  
               //! Tanım
               $apiCheck = $decoded["status"];
               
            }

            //kapat
            curl_close($curl);
            
            
            //! Login Durumuna yönlendirme
            if($apiCheck == 1) {
            
               $apiUpdateStatus = true;
               $apiUpdateMsg = "Veri Güncellendi";
               
            }
            else {
                  $apiUpdateStatus = false;
                  $apiUpdateMsg = "Veri Güncellenemedi";
            }
         
         } catch (\Throwable $th) {
               
            $apiUpdateStatus = false;
            $apiUpdateMsg = $th;
            
            echo $th;
            die();
         
            //return view('UserAdminCheckSuccess');
         }
         
      }

      
      $response = array(
         'apiToken' =>  $request->apiToken,
         'companyToken' =>  $request->companyToken,
         'file_upload_status'=>$uploadStatus,
         'file_path'=>url('upload/uploads/'.$fileName),
         'file_name'=>$fileName,
         'file_originName'=>request()->file->getClientOriginalName(),
         'file_ext'=>request()->file->getClientOriginalExtension(),
         'file_url'=>"upload/uploads/".$fileName,
         'file_url_public'=>public_path('upload/uploads'),
         'apiUpdateStatus' => $apiUpdateStatus,
         'apiUpdateMsg' => $apiUpdateMsg
      );

      return response()->json($response);

   } //! Cari Hesap - Dekont Yükleme Son

      
  //! **************** Bize Ulaşın ****************
  
  //Destek Talebi Listesi
  public function supportRequestList()
  {

      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $categoryTitle=null;
      $categoryToken=null;
      $companyToken = null;
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      } 
      
      //! Varsa
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
      
      if($userCheck ) {
         
         //! Veriler
         $apiDB=[];
         
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
         
         if($_COOKIE["userRoleToken"] == "token") {
            
            //url
            $url= $api_url."/api/supportRequestTitle/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')
            );
            
            
            $data=http_build_query($data_array);
      
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
               
            }

            //kapat
            curl_close($curl);
            
         }
         else {
            
               //url
               $url= $api_url."/api/supportRequestTitle/find_user";
               
               //Eklenecek Veriler
               $data_array=array
               (
                  'serverToken' => env('YILDIRIMDEV_ServerToken'),
                  'created_byToken'=> $_COOKIE["userToken"]
               );
               
             
               $data=http_build_query($data_array);
         
               //aç    
               $curl = curl_init();  

               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_POST, 1);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
               //veri okunuyor
               $output = curl_exec($curl);
               
               //sorun varsa
               if($e=curl_error($curl)) { echo $e; }
               else 
               {  
                  // Json verisine dönüştür
                  $decoded=json_decode($output,true);

                  //! Verileri Okuma
                  $title=$decoded["title"];
                  $tablo=$decoded["table"];
                  $status=$decoded["status"];
                  $apiDB= $decoded["DB"];
               }

               //kapat
               curl_close($curl);
                     
         
         }
         
         //! Verileri Seçiyor
         $parameter_page = request('page') ? request('page') : 1;
         $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
         $newDB = [];
         $newDBCount=0;
         
         //! ApiDb
         $apiDBCount = count($apiDB);
         $apiDBRowCount = ceil(count($apiDB) / $parameter_rowcount);
         
         $pageindex =$parameter_rowcount*($parameter_page-1);
         $pagelast =$parameter_rowcount*$parameter_page;
         
         $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
         
         for ($i=$pageindex; $i <$pagelast; $i++) { 
            $newDB[$newDBCount] = $apiDB[$i];
            $newDBCount++;
         }
         
         //! Verileri Seçiyor Son
         
         
         //! Return
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
         $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB"] = $newDB;
         $DB["apiDBCount"] = $apiDBCount;
         $DB["apiDBRowCount"] = $apiDBRowCount;
         $DB["parameter_page"] = $parameter_page;
         $DB["parameter_rowcount"] = $parameter_rowcount;
         
          
         //! Return View
         if( $_COOKIE["userRoleToken"] == "token") {  return view('supportRequestList',$DB); }
         else if($companyToken == null) { return view('errorCompany',$DB); }
         else  { return view('supportRequestList',$DB); }

      }
      else {
         return view('login');
      }   

  } //! Destek Talebi Listesi
   
       
  //! Destek Talebi - Active 
  public function supportUpdateActive(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/supportRequestTitle/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'statusToken' => $request->active == "true" ? "token10": "token8",
         'isActive'=> $request->active == "true" ? false: true,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "id" => $request->id,
          "token" => $request->token,
          "active" => $request->active == "true" ? false: true,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Destek Talebi - Active  Son
  
         
  //! Destek Talebi - Güncelleme
  public function supportUpdate(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/supportRequestTitle/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'isActive'=> $request->active == "true" ? false: true,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "id" => $request->id,
          "token" => $request->token,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Destek Talebi - Güncelleme Son
   
  //! Destek Talebi - Post
  public function supportDelete(Request $request)
  {
       //! Status
       $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/supportRequestTitle/delete_update/".$request->id;
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'deleted_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          "id" => $request->id,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
          
      );

      return response()->json($response);
  } //! Destek Talebi - Post Son
  
           
  //! Destek Talebi  Yeni
  public function supportRequestNew()
  {
      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
        
      } 
      
      if($userCheck ) { 
      
         
         //! ***** UserRole ****
         
         //! Array
         $apiDB_userType = [];
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/userType/find_serverToken";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken')
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB_userType=$decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         //! ***** UserRole Son ****
                  
         //! ***** Priority ****
         
         //! Array
         $apiDB_Priority = [];
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/priority/find_table";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'table' => "general"
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            $apiDB_Priority=$decoded["DB"];
            
         }

         //kapat
         curl_close($curl);
         
         //! ***** Priority Son ****

         
         
          //! DB Bilgisi
         $DB["name"] = $name;
         $DB["surname"] = $surname;
         $DB["userImageUrl"] = $userImageUrl;
         $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
         $DB["apiDB_userType"] = $apiDB_userType;
         $DB["apiDB_Priority"] = $apiDB_Priority;
         
         return view('supportRequestNew',$DB);
      }
      else {
         return view('login');
      }  
   
  } // Destek Talebi Yeni Son
   
          
  // Destek Talebi Ekleme
  public function supportAdd(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/supportRequestTitle/add_comment";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'title'=> $request->title,
         'description'=> $request->description,
         'priorityToken'=> $request->priorityToken,
         'statusToken'=> $request->statusToken,
         'isFile'=> $request->fileUrl ? true : false,
         'fileUrl'=> $request->fileUrl,
         'fileUploadUrl'=> $request->fileUploadUrl,
         'companyToken'=> $_COOKIE["companyToken"],
         'created_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'created_byToken'=> $_COOKIE["userToken"],
          'companyToken'=> $_COOKIE["companyToken"],
          'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
      );

      return response()->json($response);
  }  // Destek Talebi Ekleme Son
  
           
  //! Destek Talebi  Detayı
  public function supportRequestDetail($id)
  {
      
      try {
        
               //! Tanım
               $userCheck = 0;
               $userToken = "";
               $name = "Name";
               $surName = "surName";
               $categoryTitle="categoryTitle";
               $categoryToken="categoryToken";
               $userImageUrl = "userImageUrl";
               
               $support_active=null;
               $support_id=null;
               $support_token=null;
               
               //? Cookie Varmı
               if(isset($_COOKIE["userCheck"])) {
                  
                  $userCheck = 1;
                  $userToken=$_COOKIE["userToken"];
                  $name=$_COOKIE["name"];
                  $surname=$_COOKIE["surname"];
                  $userImageUrl=$_COOKIE["userImageUrl"];
                  
                  $categoryTitle=$_COOKIE["categoryTitle"];
                  $categoryToken=$_COOKIE["categoryToken"];
               } 
               
               if($userCheck ) {
                  
                  //! Veriler
                  $apiDB=[];
                  
                  //Api Adresi 
                  $api_url=env('YILDIRIMDEV_API_URL');
               
                  //url
                  $url= $api_url."/api/supportRequestComment/find_supportRequestTitleId/".$id;
                  
                  
                  //aç    
                  $curl = curl_init();  

                  curl_setopt($curl, CURLOPT_URL, $url);
                  
                  // SSL important
                  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($curl, CURLOPT_POST, 0);

                  
                  //veri okunuyor
                  $output = curl_exec($curl);
                  
                  //sorun varsa
                  if($e=curl_error($curl)) { echo $e; }
                  else 
                  {  
                     // Json verisine dönüştür
                     $decoded=json_decode($output,true);

                     //! Verileri Okuma
                     $title=$decoded["title"];
                     $tablo=$decoded["table"];
                     $status=$decoded["status"];
                     $apiDB= $decoded["DB"];
                     
                     $support_active=$decoded["support_active"];
                     $support_id=$decoded["support_id"];
                     $support_token=$decoded["support_token"];
                     
                  }

                  //kapat
                  curl_close($curl);
                  
                  //! Kullanıcı Bilgisi
                  $DB["name"] = $name;
                  $DB["surname"] = $surname;
                  $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
                  $DB["userToken"] = $_COOKIE["userToken"];
                  
                  //! SupportTitle
                  $DB["support_active"] = $support_active;
                  $DB["support_id"] = $support_id;
                  $DB["support_token"] = $support_token;
                  
               
                  //! DB Bilgisi
                  $DB["id"] = $id;
                  $DB["apiDB"] = $apiDB;
                  
               
                  return view('supportRequestDetail',$DB);
               }
               else {
                  return view('login');
               }           
            
      } 
      catch (\Throwable $th) { 
         throw $th;
         //return view("error404"); 
      }
   
  } //! Destek Talebi  Detayı Son
   
             
  //! Destek Talebi Açıklama Ekleme
  public function supportRequestCommentAdd(Request $request)
  {
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/supportRequestComment/add";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverId' => env('YILDIRIMDEV_ServerId'),
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'supportRequestTitleId'=> $request->supportRequestTitleId,
         'supportRequestTitleToken'=> $request->supportRequestTitleToken,
         'description'=> $request->description,
         'isFile'=> $request->fileUrl ? true : false,
         'fileUrl'=> $request->fileUrl,
         'fileUploadUrl'=> $request->fileUploadUrl,
         'created_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'created_byToken'=> $_COOKIE["userToken"],
          'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
      );

      return response()->json($response);
  } //! Destek Talebi Açıklama Ekleme Son
  
    
    //! Direk Mesaj
   public function direkContact()
   {
      
       //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $categoryTitle=null;
      $categoryToken=null;
      $companyToken = null;
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      } 
      
      //! Varsa
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
      
      //! Return
      $DB["name"] = $name;
      $DB["surname"] = $surname;
      $DB["userImageUrl"] = $userImageUrl;
      $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
   
      return view('direkContact',$DB);
   }   //! Direk Mesaj Son
      
   //! **************** Banka Listesi ****************
  
   //! Banka Listesi
   public function bankList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $status=false;
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');             
           
            //url
            $url= $api_url."/api/bank/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')                  
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
           }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
         
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
         
            
            //echo json_encode($apiDB); die();
            //echo json_encode($apiDB[0]["id"]); die();
            //echo $apiDB[0]["productName"]; die();
            
            return view('bankList',$DB);
            
         }
         else {
            return view('login');
         }   
      
   } //! Banka Listeleme
   
                   
   //! Banka Ekle - Post
   public function bankAdd (Request $request)
   {
         // //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/bank/add";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverId' => env('YILDIRIMDEV_ServerId'),
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'bankTitle'=> $request->bankTitle,
            'created_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
         );

         return response()->json($response);
   }  //! Banka Ekle - Post Son
   
   //! Banka Güncelleme Active
   public function bankUpdateActive(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/bank/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'isActive'=> $request->active == "true" ? false: true,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "token" => $request->token,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Banka Güncelleme Active Son
  
           
   //! Banka Silme - Post
   public function bankDelete(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/bank/delete/".$request->id;
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'deleted_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "id" => $request->id,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
            
         );

         return response()->json($response);
   } //! Banka Silme - Post Son
   
                 
  //! Banka Company Update
  public function bankUpdate(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/bank/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'bankTitle'=> $request->bankTitle,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
          
      );

      return response()->json($response);
  } //! Banka Company Update Son   
   
      
   //! **************** Marka Listesi ****************
   
   //! Marka Listesi
   public function brandList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');             
           
            //url
            $url= $api_url."/api/brand/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')                  
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
         
            
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
         
            
            //echo json_encode($apiDB); die();
            //echo json_encode($apiDB[0]["id"]); die();
            //echo $apiDB[0]["productName"]; die();
            
            return view('brandList',$DB);
            
         }
         else {
            return view('login');
         }   
      
   } //! Marka Listeleme
   
             
   //! Marka Ekle - Post
   public function brandAdd(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/add";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverId' => env('YILDIRIMDEV_ServerId'),
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'brandTitle'=> $request->brandTitle,
            'created_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
         );

         return response()->json($response);
   }  //! Marka Ekle - Post Son
   
   
   //! Marka Güncelleme Active
   public function brandUpdateActive(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'isActive'=> $request->active == "true" ? false: true,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "token" => $request->token,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Marka Güncelleme Active Son
   
         
   //! Marka Silme - Post
   public function brandDelete(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/delete/".$request->id;
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'deleted_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "id" => $request->id,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
            
         );

         return response()->json($response);
   } //! Marka Silme - Post Son
   
           
  //! Marka Company Update
  public function brandUpdate(Request $request)
  {
      
      //! Status
      $general_status=0;
   
      //Api Adresi 
      $api_url=env('YILDIRIMDEV_API_URL');
   
      //url
      $url= $api_url."/api/brand/update";
      
      //Eklenecek Veriler
      $data_array=array
      (
         'serverToken' => env('YILDIRIMDEV_ServerToken'),
         'token'=> $request->token,
         'brandTitle'=> $request->brandTitle,
         'updated_byToken'=> $_COOKIE["userToken"]
      );

      $data=http_build_query($data_array);
      
      //aç    
      $curl = curl_init();  

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         
      //veri okunuyor
      $output = curl_exec($curl);
      
      //sorun varsa
      if($e=curl_error($curl))
      {
         echo $e;
         $general_status =0;
      }
      else
      {  
         // Json verisine dönüştür
         $decoded=json_decode($output,true);

         $title=$decoded["title"];
         $tablo=$decoded["table"];
         $status=$decoded["status"];
         
         $general_status =$status;
      }

      //kapat
      curl_close($curl);

      $response = array(
          'status' => $general_status,
          'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
      );

      return response()->json($response);
  } //! Marka Company Update Son
  
  
   //! **************** CargoCompany ****************
     
   //! Kargo Firma Listesi
   public function CargoCompanyList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');             
           
            //url
            $url= $api_url."/api/cargoCompany/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')                  
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
         
            
            //echo json_encode($apiDB); die();
            //echo json_encode($apiDB[0]["id"]); die();
            //echo $apiDB[0]["productName"]; die();
            
            return view('cargoCompanyList',$DB);
            
         }
         else {
            return view('login');
         }   
      
   } //! Kargo Firma Listesi Son
   
                   
   //! Kargo Firma  Ekle - Post
   public function CargoCompanyAdd (Request $request)
   {
         // //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/cargoCompany/add";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverId' => env('YILDIRIMDEV_ServerId'),
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'cargoCompanyTitle'=> $request->cargoCompanyTitle,
            'cargo_customerId'=> $request->cargo_customerId ? $request->cargo_customerId : " " ,
            'created_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
         );

         return response()->json($response);
   }  //! Kargo Firma  Ekle - Post Son
   
                      
   //! Kargo Firma  Güncelle - Post
   public function CargoCompanyUpdate (Request $request)
   {
         // //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/cargoCompany/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'cargoCompanyTitle'=> $request->cargoCompanyTitle,
            'cargo_customerId'=> $request->cargo_customerId,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
         );

         return response()->json($response);
   }  //! Kargo Firma  Güncelle - Post Son
   
                
   //! Kargo Firma Güncelleme Active
   public function CargoCompanyUpdateActive(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/cargoCompany/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'isActive'=> $request->active == "true" ? false: true,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "token" => $request->token,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Kargo Firma Güncelleme Active Son
   
         
   //! Kargo Firma Silme - Post
   public function CargoCompanyDelete(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/cargoCompany/delete/".$request->id;
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'deleted_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "id" => $request->id,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
            
         );

         return response()->json($response);
   } //! Kargo Firma Silme - Post Son
            

   //! Kargo Export
   public function CargoExport()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('cargoExport',$data);
   } //! Kargo Export Son
   
   
   //! Kargo Export - Url
   public function CargoExportUrl($id,$companyId)
   {
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $company=[];
            $warehouseInfo=[];
            $order=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
             //url
            $url= $api_url."/api/order/export/cargo";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken'),
               'orderId'=> $id,
               'companyId'=> $companyId
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               
               $company= $decoded["company"];
               $warehouseInfo= $decoded["warehouseInfo"];
               $order= $decoded["order"];
            }

            //kapat
            curl_close($curl);
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
           
            $DB["company"] = $company;
            $DB["warehouseInfo"] = $warehouseInfo;
            $DB["order"] = $order;
           
            
            return view('cargoExportUrl',$DB);
            
         }
         else {
            return view('login');
         }   
     
     
   
   } //! Kargo Export Son
   
   
   
   //! **************** CompanyCategory ****************
     
   //! Firma Kategori Listesi
   public function CompanyCategoryList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');             
           
            //url
            $url= $api_url."/api/category/find_serverToken";
            
            //Eklenecek Veriler
            $data_array=array
            (
               'serverToken' => env('YILDIRIMDEV_ServerToken')                  
            );

            $data=http_build_query($data_array);
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
            //veri okunuyor
            $output = curl_exec($curl);
            
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
         
            
            //echo json_encode($apiDB); die();
            //echo json_encode($apiDB[0]["id"]); die();
            //echo $apiDB[0]["productName"]; die();
            
            return view('companyCategoryList',$DB);
            
         }
         else {
            return view('login');
         }   
      
   } //! Firma Kategori Listesi Son
   
                   
   //! Firma Kategori  Ekle - Post
   public function CompanyCategoryAdd (Request $request)
   {
         // //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/category/add";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverId' => env('YILDIRIMDEV_ServerId'),
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'categoryTitle'=> $request->categoryTitle,
            'created_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
         );

         return response()->json($response);
   }  //! Firma Kategori  Ekle - Post Son
   
                      
   //! Firma Kategori  Güncelle - Post
   public function CompanyCategoryUpdate (Request $request)
   {
         // //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/category/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'cargoCompanyTitle'=> $request->cargoCompanyTitle,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi'
         );

         return response()->json($response);
   }  //! Firma Kategori  Güncelle - Post Son
   
                
   //! Firma Kategori Güncelleme Active
   public function CompanyCategoryUpdateActive(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/category/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'isActive'=> $request->active == "true" ? false: true,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "token" => $request->token,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Firma Kategori Güncelleme Active Son
   
         
   //! Firma Kategori Silme - Post
   public function CompanyCategoryDelete(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/category/delete/".$request->id;
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'deleted_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "id" => $request->id,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
            
         );

         return response()->json($response);
   } //! Firma Kategori Silme - Post Son
            

   
  //! **************** Ajax ****************
  
  //! Get
  public function ajaxFunctionExampleGet()
  {
      $response = array(
          'status' => 'success',
          'ajaxStatus' => 'get'
      );

     return response()->json($response); 
  } //! Get Son

  
  
  //! Ajax - Post
  public function ajaxFunctionExamplePost(Request $request)
  {
      $user_name = $request->name;

      $response = array(
          'status' => 'success',
          'ajaxStatus' => 'post',
          'user_name' => $request->name,
      );

      return response()->json($response);
  } //! Ajax - Post Son
  
  
   //! **************** Sabit ****************
  
    //Sabit
   public function Sabit()
   {
      //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $categoryTitle=null;
      $categoryToken=null;
      $companyToken = null;
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      } 
      
      //! Varsa
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
      
      //! Return
      $DB["name"] = $name;
      $DB["surname"] = $surname;
      $DB["userImageUrl"] = $userImageUrl;
      $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
   
      return view('0_sabit',$DB);
   }  //Sabit Son

   
   //! **************** Sabit Listesi ****************
   
   //Sabit Listesi
   public function SabitList()
   {
      
         //! Tanım
         $userCheck = 0;
         $userToken = "";
         $name = "Name";
         $surName = "surName";
         $categoryTitle="categoryTitle";
         $categoryToken="categoryToken";
         $userImageUrl = "userImageUrl";
         
         //? Cookie Varmı
         if(isset($_COOKIE["userCheck"])) {
            
            $userCheck = 1;
            $userToken=$_COOKIE["userToken"];
            $name=$_COOKIE["name"];
            $surname=$_COOKIE["surname"];
            $userImageUrl=$_COOKIE["userImageUrl"];
         } 
         
         if($userCheck ) {
            
            //! Veriler
            $apiDB=[];
            
            //Api Adresi 
            $api_url=env('YILDIRIMDEV_API_URL');
         
            //url
            $url= $api_url."/api/product/all";
            
            
            //aç    
            $curl = curl_init();  

            curl_setopt($curl, CURLOPT_URL, $url);
            
            // SSL important
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 0);

            
            //veri okunuyor
            $output = curl_exec($curl);
            
            //sorun varsa
            if($e=curl_error($curl)) { echo $e; }
            else 
            {  
               // Json verisine dönüştür
               $decoded=json_decode($output,true);

               //! Verileri Okuma
               $title=$decoded["title"];
               $tablo=$decoded["table"];
               $status=$decoded["status"];
               $apiDB= $decoded["DB"];
            }

            //kapat
            curl_close($curl);
            
            //! Verileri Seçiyor
            $parameter_page = request('page') ? request('page') : 1;
            $parameter_rowcount = request('rowcount') ? request('rowcount') : 10;
            $newDB = [];
            $newDBCount=0;
            
            //! ApiDb
            $apiDBCount = $status ? count($apiDB) : 0;
            $apiDBRowCount = $status ? ceil(count($apiDB) / $parameter_rowcount) : 0;
            
            $pageindex =$parameter_rowcount*($parameter_page-1);
            $pagelast =$parameter_rowcount*$parameter_page;
            
            $pagelast = $pagelast >= $apiDBCount ? $apiDBCount : $pagelast;
            
            for ($i=$pageindex; $i <$pagelast; $i++) { 
               $newDB[$newDBCount] = $apiDB[$i];
               $newDBCount++;
            }
            
            //! Verileri Seçiyor Son
            
         
            
            
            
            //! Return
            $DB["name"] = $name;
            $DB["surname"] = $surname;
            $DB["userImageUrl"] = $userImageUrl;
            $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
            $DB["apiDB"] = $newDB;
            $DB["apiDBCount"] = $apiDBCount;
            $DB["apiDBRowCount"] = $apiDBRowCount;
            $DB["parameter_page"] = $parameter_page;
            $DB["parameter_rowcount"] = $parameter_rowcount;
         
            
            //echo json_encode($apiDB); die();
            //echo json_encode($apiDB[0]["id"]); die();
            //echo $apiDB[0]["productName"]; die();
            
            return view('0_sabit_table',$DB);
            
         }
         else {
            return view('login');
         }   
      
   } //! Sabit Listeleme
   
                
   //! Sabit Ekle - Post
   public function SabitAdd (Request $request)
   {
         // //! Status
         $general_status=0;
      
         // //Api Adresi 
         // $api_url=env('YILDIRIMDEV_API_URL');
      
         // //url
         // $url= $api_url."/api/brand/add";
         
         // //Eklenecek Veriler
         // $data_array=array
         // (
         //    'serverId' => env('YILDIRIMDEV_ServerId'),
         //    'serverToken' => env('YILDIRIMDEV_ServerToken'),
         //    'brandTitle'=> $request->brandTitle,
         //    'created_byToken'=> $_COOKIE["userToken"]
         // );

         // $data=http_build_query($data_array);
         
         // //aç    
         // $curl = curl_init();  

         // curl_setopt($curl, CURLOPT_URL, $url);
         // curl_setopt($curl, CURLOPT_POST, 1);
         // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         // //veri okunuyor
         // $output = curl_exec($curl);
         
         // //sorun varsa
         // if($e=curl_error($curl))
         // {
         //    echo $e;
         //    $general_status =0;
         // }
         // else
         // {  
         //    // Json verisine dönüştür
         //    $decoded=json_decode($output,true);

         //    $title=$decoded["title"];
         //    $tablo=$decoded["table"];
         //    $status=$decoded["status"];
            
         //    $general_status =$status;
         // }

         // //kapat
         // curl_close($curl);

         $response = array(
            'status' => $general_status,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Eklenemedi' : 'Veri Eklendi'
         );

         return response()->json($response);
   }  //! Sabit Ekle - Post Son
   

   //! Sabit  Update
   public function SabitUpdate(Request $request)
   {
         
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'brandTitle'=> $request->brandTitle,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Sabit  Update Son

             
   //! Sabit Güncelleme Active
   public function SabitUpdateActive(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/product/update";
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'token'=> $request->token,
            'isActive'=> $request->active == "true" ? false: true,
            'updated_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "token" => $request->token,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Güncellenemedi' : 'Veri Güncellendi',
            
         );

         return response()->json($response);
   } //! Sabit Güncelleme Active Son
   
   
   //! Sabit Silme - Post
   public function SabitDelete(Request $request)
   {
         //! Status
         $general_status=0;
      
         //Api Adresi 
         $api_url=env('YILDIRIMDEV_API_URL');
      
         //url
         $url= $api_url."/api/brand/delete/".$request->id;
         
         //Eklenecek Veriler
         $data_array=array
         (
            'serverToken' => env('YILDIRIMDEV_ServerToken'),
            'deleted_byToken'=> $_COOKIE["userToken"]
         );

         $data=http_build_query($data_array);
         
         //aç    
         $curl = curl_init();  

         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
         //veri okunuyor
         $output = curl_exec($curl);
         
         //sorun varsa
         if($e=curl_error($curl))
         {
            echo $e;
            $general_status =0;
         }
         else
         {  
            // Json verisine dönüştür
            $decoded=json_decode($output,true);

            $title=$decoded["title"];
            $tablo=$decoded["table"];
            $status=$decoded["status"];
            
            $general_status =$status;
         }

         //kapat
         curl_close($curl);

         $response = array(
            'status' => $general_status,
            "id" => $request->id,
            'created_byToken'=> $_COOKIE["userToken"],
            'msg' => $general_status == 0 ? 'Veri Silinemedi' : 'Veri Silindi',
            
         );

         return response()->json($response);
   } //! Sabit Silme - Post Son

   
   //! **************** Sabit Listesi Son **************** 
      
      
   //! **************** Sabit Dosya Yükleme ****************
   
   //Sabit
   public function SabitFileUpload()
   {
       //! Tanım
      $userCheck = 0;
      $userToken = "";
      $name = "Name";
      $surName = "surName";
      $userImageUrl = "userImageUrl";
      $categoryTitle=null;
      $categoryToken=null;
      $companyToken = null;
      
      //? Cookie Varmı
      if(isset($_COOKIE["userCheck"])) {
         
         $userCheck = 1;
         $userToken=$_COOKIE["userToken"];
         $name=$_COOKIE["name"];
         $surname=$_COOKIE["surname"];
         $userImageUrl=$_COOKIE["userImageUrl"];
      } 
      
      //! Varsa
      if(isset($_COOKIE["companyToken"])) { $companyToken=$_COOKIE["companyToken"]; }
      if(isset($_COOKIE["categoryToken"])) { $categoryToken=$_COOKIE["categoryToken"]; }
      
      //! Return
      $DB["name"] = $name;
      $DB["surname"] = $surname;
      $DB["userImageUrl"] = $userImageUrl;
      $DB["userRoleToken"] = $_COOKIE["userRoleToken"];
   
      return view('0_sabit_file',$DB);
     
   }  //Sabit Son
  
        
   //! Post - File Upload
   public function FileUploadControl(Request $request)
   {

      $request->validate([
         'file' => 'required',
      ]);
      
      $fileName = time().'.'.$request->file->extension();  
      
      //$file = $request->file('file');
      $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
      
      //! Tanım
      $uploadStatus = false;

      if($file_status) {  $uploadStatus = true; }

      
      $response = array(
         'userToken' =>  $request->userToken,
         'file_upload_status'=>$uploadStatus,
         'file_path'=>url('upload/uploads/'.$fileName),
         'file_name'=>$fileName,
         'file_originName'=>request()->file->getClientOriginalName(),
         'file_ext'=>request()->file->getClientOriginalExtension(),
         'file_url'=>"upload/uploads/".$fileName,
         'file_url_public'=>public_path('upload/uploads')
      );

      return response()->json($response);

   }  //! Post - File Upload Son
   
           
   //! Post - Çoklu File Upload
   public function FileUploadMultiControl(Request $request)
   {

      $request->validate([
         'files' => 'required',
      ]);
      
      
      $fileControl =0;
      $fileData =array(); //! Yeni Data
      
      
     if($request->hasfile('files'))
      {
         $fileControl = 1;
      
         //! Dosyaları Alıyor
         foreach($request->file('files') as $file)
         {
            //! Dosya Yükleme
            $fileName=time().'_'.$file->getClientOriginalName(); //! Dosya Adı
            //$fileName = time().'.'.$file->extension();  
            $file_status= $file->move(public_path('upload/uploads'), $fileName); //!  //! Dosya Yüklüyor
               
               if($file_status) {
               
                  //! Json içine kayıt yapıyor
                 $fileData[] =  array(
                    'file_path'=>url('upload/uploads/'.$fileName),
                    'file_name'=>$fileName,
                    'file_originName'=>$file->getClientOriginalName(),
                    'file_ext'=>$file->getClientOriginalExtension(),
                    'file_url'=>"upload/uploads/".$fileName,
                 );
                  
               }
               
              
               
               
         }   //! Dosyaları Alıyor Son
      }
      
 

      
      $response = array(
         'userToken' =>  $request->userToken,
         'fileControl' =>  $fileControl,
         'files' =>  $fileData,
         'file_url_public'=>public_path('upload/uploads')
      );

      return response()->json($response);

   }  //! Post - Çoklu File Upload Son
   
      
   //! Post -  File Upload - Api
   public function FileUploadControlApi(Request $request)
   {

      $request->validate([
         'file' => 'required',
      ]);
      
      $fileName = time().'.'.$request->file->extension();  
      
      //$file = $request->file('file');
      $file_status= $request->file->move(public_path('upload/uploads'), $fileName);  
      
      //! Tanım
      $uploadStatus = false;
      $apiUpdateStatus = false;
      $apiUpdateMsg = "";

      if($file_status) { 
         $uploadStatus = true;
         $apiUpdateStatus = true;
         
         // try {
      
         //    //Veri Okuma
         //    // [ Name] - değerlerine göre oku
         //    $token= $request->_token;
         //    $userToken= $request->userToken;
            
         //    //! Tanım
         //    $apiCheck=0;
         
         //    //Api Adresi 
         //    $api_url=env('YILDIRIMDEV_API_URL');
         
         //    //url
         //    $url= $api_url."/api/current/update";
            
         //    //Eklenecek Veriler
         //    $data_array=array
         //    (
         //       'serverToken' => env('YILDIRIMDEV_ServerToken'),
         //       'updated_byToken'=> $_COOKIE["userToken"],
         //       'token'=> $request->apiToken,
         //       'invoiceFileUrl'=> url('upload/uploads/'.$fileName)
         //    );

         //    $data=http_build_query($data_array);
            
            
            
            
         //    //aç    
         //    $curl = curl_init();  

         //    curl_setopt($curl, CURLOPT_URL, $url);
         //    curl_setopt($curl, CURLOPT_POST, 1);
         //    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         //    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               
         //    //veri okunuyor
         //    $output = curl_exec($curl);     
            
         //    //sorun varsa
         //    if($e=curl_error($curl))
         //    {
         //       echo $e;
         //    }
         //    else
         //    {  
         //       // Json verisine dönüştür
         //       $decoded=json_decode($output,true);

         //       // $title=$decoded["title"];
         //       // $tablo=$decoded["table"];
         //       $status=$decoded["status"];
                  
         //       //! Tanım
         //       $apiCheck = $decoded["status"];
               
         //    }

         //    //kapat
         //    curl_close($curl);
            
            
         //    //! Login Durumuna yönlendirme
         //    if($apiCheck == 1) {
            
         //       $apiUpdateStatus = true;
         //       $apiUpdateMsg = "Veri Güncellendi";
               
         //    }
         //    else {
         //          $apiUpdateStatus = false;
         //          $apiUpdateMsg = "Veri Güncellenemedi";
         //    }
         
         // } catch (\Throwable $th) {
               
         //    $apiUpdateStatus = false;
         //    $apiUpdateMsg = $th;
            
         //    echo $th;
         //    die();
         
         //    //return view('UserAdminCheckSuccess');
         // }
         
      }

      
      $response = array(
         'apiToken' =>  $request->apiToken,
         'file_upload_status'=>$uploadStatus,
         'file_path'=>url('upload/uploads/'.$fileName),
         'file_name'=>$fileName,
         'file_originName'=>request()->file->getClientOriginalName(),
         'file_ext'=>request()->file->getClientOriginalExtension(),
         'file_url'=>"upload/uploads/".$fileName,
         'file_url_public'=>public_path('upload/uploads'),
         'apiUpdateStatus' => $apiUpdateStatus,
         'apiUpdateMsg' => $apiUpdateMsg
      );

      return response()->json($response);

   } //! Post -  File Upload - Api Son
      
   //! **************** Sabit Dosya Yükleme Son ****************

  

   //! **************** Sabit Sayfalar ****************

   //! Error 404
   public function error404()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('error404',$data);
   }    //! Error 404 Son
   
   
   //! Error 500
   public function error500()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('error500',$data);
   }    //! Error 500 Son
   
   
   
   //! Firma Eksik
   public function errorCompanyBlock()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userRoleToken"] = "token3";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('errorCompany',$data);
   } //! Firma Eksik Son
   
   
   
   
   //! Hesabınız Askıda
   public function accountBlock()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userRoleToken"] = "token3";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('accountBlock',$data);
   } //! Hesabınız Askıda Son
   
   
   //! Sipariş Eksik
   public function errorOrder()
   {
      
     $data["name"] = "Name";
     $data["surname"] = "Surname";
     $data["userImageUrl"] = "https://data.yildirimdev.com/images/0-profil/Emma%20Johnson.jpg";
     
      return view('errorOrder',$data);
   } //! Sipariş Eksik Son

   
   //! **************** Sabit Sayfalar Son ****************
   

}