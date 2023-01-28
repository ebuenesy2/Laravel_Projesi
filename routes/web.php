<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;



//! Login
Route::get('/login', [App::class,'Login']) -> name("login");
Route::post('/login/control', [App::class,'LoginControl']) -> name("login.control");

//! Register
Route::get('/register', [App::class,'Register']) -> name("register");
Route::post('/register/control', [App::class,'RegisterControl']) -> name("register.control");

//! Forgot
Route::get('/forgot_password', [App::class,'Forgot_password']) -> name("forgot_password");
Route::post('/forgot_password/control', [App::class,'Forgot_passwordControl']) -> name("forgot_password.control");


//! Account - Check
Route::get('/user_admin_check', [App::class,'UserAdminCheck']) -> name("user_admin_check");
Route::post('/user_admin_check/control', [App::class,'UserAdminCheckControl']) -> name("user_admin_check.control");

//! Account - Check - Succes
Route::get('/user_admin_check_success', [App::class,'UserAdminCheckSuccess']) -> name("user_admin_check_success");

//! Account - Reset Password
Route::get('/reset-password', [App::class,'ResetPassword']) -> name("account.reset.password");
Route::post('/reset-password/control', [App::class,'ResetPasswordControl']) -> name("account.reset.password.control");

//! Index
Route::get('/', [App::class,'Index']) -> name("index");

//! Account-Setting
Route::get('/account_settings', [App::class,'AccountSettings']) -> name("account.settings");


//! User Info Settings
Route::post('/user/info/setting', [App::class,'UserInfoSetting']) -> name("user.info.settings");
Route::post('/user/pass/setting', [App::class,'UserPassSetting']) -> name("user.pass.settings");

//! User Company Settings
Route::post('/user/company/update', [App::class,'UserCompanyUpdate']) -> name("user.company.update");
Route::post('/user/company/add', [App::class,'UserCompanyAdd']) -> name("user.company.add");

//! User bankAccount Settings
Route::post('/user/bankAccount/update', [App::class,'UserBankAccountUpdate']) -> name("user.bankAccount.update");
Route::post('/user/bankAccount/add', [App::class,'UserBankAccountAdd']) -> name("user.bankAccount.add");

//************* File Upload ***************** */
Route::post('/user/file_upload/control', [App::class,'UserFileUploadControl']) -> name("user.file.upload.control");
Route::post('/personalIdentityPhoto/file_upload/control', [App::class,'PersonalIdentityPhotoFileUploadControl']) -> name("personalIdentityPhoto.file.upload.control");
Route::post('/taxSheet/file_upload/control', [App::class,'taxSheetFileUploadControl']) -> name("taxSheet.file.upload.control");
Route::post('/tradeRegistryGazette/file_upload/control', [App::class,'tradeRegistryGazetteFileUploadControl']) -> name("tradeRegistryGazette.file.upload.control");
Route::post('/circularOfSignature/file_upload/control', [App::class,'circularOfSignatureFileUploadControl']) -> name("circularOfSignature.file.upload.control");
Route::post('/chamberOfCommerceRegistration/file_upload/control', [App::class,'chamberOfCommerceRegistrationFileUploadControl']) -> name("chamberOfCommerceRegistration.file.upload.control");
Route::post('/serviceContract/file_upload/control', [App::class,'serviceContractFileUploadControl']) -> name("serviceContract.file.upload.control");


//! ******* Kullanıcı Kontrolu ********

//! Kullanıcılar
Route::get('/user/list', [App::class,'userList']) -> name("user.list");
Route::post('/user/update', [App::class,'userUpdate']) -> name("user.update");
Route::post('/user/update/role', [App::class,'userUpdateRole']) -> name("user.update.role");

//! Firma
Route::get('/company/list', [App::class,'companyList']) -> name("company.list");
Route::post('/company/update', [App::class,'companyUpdate']) -> name("company.update");
Route::post('/company/update/active', [App::class,'companyUpdateActive']) -> name("company.update.active");
Route::post('/company/update/paymentdate', [App::class,'companyUpdatePayment']) -> name("company.update.payment");



//! ******* Ürünler ********

//! Ürünler
Route::get('/product/list', [App::class,'ProductList']) -> name("product.list");

//! Ürün Ekleme
Route::get('/product/add', [App::class,'ProductAdd']) -> name("product.add");
Route::get('/product/add/step2', [App::class,'ProductAddStepTwo']) -> name("product.add.step.two");

//! Ürün Resim Yükleme
Route::post('/product/file_upload/control', [App::class,'ProductFileUploadControl']) -> name("product.file.upload.control");

//! Önizleme
Route::get('/product/add/step3', [App::class,'ProductAddStepThree']) -> name("product.add.step.three");

//! Ürün Ekle
Route::post('/product/add/post', [App::class,'ProductAddPost']) -> name("product.add.post");
Route::post('/product/add/post/multi', [App::class,'ProductAddPostMulti']) -> name("product.add.post.multi");

//! Ürün Entegrasyon
Route::get('/product/integration', [App::class,'ProductIntegration']) -> name("product.integration");

//! Ürün Silme ve Güncelle
Route::post('/product/delete', [App::class,'ProductDelete']) -> name("product.delete");
Route::post('/product/update/active', [App::class,'ProductUpdateActive']) -> name("product.update.active");

//! Ürün Görüntüleme
Route::get('/product/view/{id}', [App::class,'ProductView']) -> name("product.view");

//! Ürün Güncelleme
Route::get('/product/edit/{id}', [App::class,'ProductEdit']) -> name("product.edit");
Route::post('/product/update/step1', [App::class,'ProductUpdateStep1']) -> name("product.update.step1");
Route::get('/product/edit/{id}/step2', [App::class,'ProductEditStep2']) -> name("product.edit.step2");
Route::post('/product/update/step2', [App::class,'ProductUpdateStep2']) -> name("product.update.step1");
Route::get('/product/edit/{id}/step3', [App::class,'ProductEditStep3']) -> name("product.edit.step3");

//! ******* Sipariş ******** 

//! Siparişler
Route::get('/orders/list', [App::class,'ordersList']) -> name("orders.list");
Route::post('/orders/updated/product', [App::class,'ordersUpdateProduct']) -> name("orders.update.product");
Route::post('/orders/updated/cargo', [App::class,'ordersUpdateCargo']) -> name("orders.update.cargo");
Route::post('/orders/updated/cargo/trackingCode', [App::class,'ordersUpdateCargoTrackingCode']) -> name("orders.update.cargo.trackingCode");
Route::post('/orders/search/company', [App::class,'ordersSearchCompany']) -> name("orders.search.company");

//! Kargo Çıktısı
Route::get('/cargo/export', [App::class,'CargoExport']) -> name("cargo.export");
Route::get('/cargo/export/{id}/{companyId}', [App::class,'CargoExportUrl']) -> name("cargo.export.url");


//! Kargolar
Route::get('/cargo/list', [App::class,'cargoList']) -> name("cargo.list");


//! ******* Finans ********

//! Cari Hesap
Route::get('/current/list', [App::class,'currentList']) -> name("current.list");
Route::post('/current/invoice/file_upload/control', [App::class,'invoiceFileUploadControl']) -> name("current.invoice.file.upload.control"); //! Fatura
Route::post('/current/receipt/file_upload/control', [App::class,'receiptFileUploadControl']) -> name("current.receipt.file.upload.control"); //! Dekont


//! ******* Bize Ulaşın ********

//! Destek Talebi
Route::get('/supportrequest/list', [App::class,'supportRequestList']) -> name("supportrequest.list");
Route::post('/supportrequest/update/active', [App::class,'supportUpdateActive']) -> name("supportrequest.update.active");
Route::post('/supportrequest/update', [App::class,'supportUpdate']) -> name("supportrequest.update");
Route::post('/supportrequest/delete', [App::class,'supportDelete']) -> name("supportrequest.delete");

//! Destek Talebi Okuma ve Cevap Verme
Route::get('/supportrequest/add', [App::class,'supportRequestNew']) -> name("supportrequest.new");
Route::post('/supportrequest/add', [App::class,'supportAdd']) -> name("supportrequest.add");
Route::get('/supportrequest/detail/{id}', [App::class,'supportRequestDetail']) -> name("supportrequest.detail");
Route::post('/supportRequestComment/add', [App::class,'supportRequestCommentAdd']) -> name("supportRequestComment.add");

//! Direk Mesaj
Route::get('/direct/contact', [App::class,'direkContact']) -> name("direct.contact");


//! ******* AYARLAR ********


//! Banka
Route::get('/bank/list', [App::class,'bankList']) -> name("bank.list"); 
Route::post('/bank/add', [App::class,'bankAdd']) -> name("bank.add");
Route::post('/bank/update/active', [App::class,'bankUpdateActive']) -> name("bank.update.active");
Route::post('/bank/delete', [App::class,'bankDelete']) -> name("bank.delete");
Route::post('/bank/update', [App::class,'bankUpdate']) -> name("bank.update");


//! Marka
Route::get('/brand/list', [App::class,'brandList']) -> name("brand.list");
Route::post('/brand/add', [App::class,'brandAdd']) -> name("brand.add");
Route::post('/brand/update/active', [App::class,'brandUpdateActive']) -> name("brand.update.active");
Route::post('/brand/delete', [App::class,'brandDelete']) -> name("brand.delete");
Route::post('/brand/update', [App::class,'brandUpdate']) -> name("brand.update");


//! Kargo Firma Ayarları
Route::get('/cargo/company/list', [App::class,'CargoCompanyList']) -> name("cargo.company.list");
Route::post('/cargo/company/add', [App::class,'CargoCompanyAdd']) -> name("cargo.company.add");
Route::post('/cargo/company/update', [App::class,'CargoCompanyUpdate']) -> name("cargo.company.update");
Route::post('/cargo/company/update/active', [App::class,'CargoCompanyUpdateActive']) -> name("cargo.company.update.active");
Route::post('/cargo/company/delete', [App::class,'CargoCompanyDelete']) -> name("cargo.company.delete");

//!Firma Kategori Ayarları
Route::get('/company/category/list', [App::class,'CompanyCategoryList']) -> name("company.category.list");
Route::post('/company/category/add', [App::class,'CompanyCategoryAdd']) -> name("company.category.add");
Route::post('/company/category/update', [App::class,'CompanyCategoryUpdate']) -> name("company.category.update");
Route::post('/company/category/update/active', [App::class,'CompanyCategoryUpdateActive']) -> name("company.category.update.active");
Route::post('/company/category/delete', [App::class,'CompanyCategoryDelete']) -> name("company.category.delete");



//************* Hata Sayfası ***************** */
Route::fallback(function(){ return view("error404"); });


//************* Ajax ***************** */
//! Ajax
Route::get('/ajax/example/get', [App::class,'ajaxFunctionExampleGet']) -> name("ajax.get");
Route::post('/ajax/example/post', [App::class,'ajaxFunctionExamplePost']) -> name("ajax.post");


//************* Sabit ***************** */

//! Sabit
Route::get('/sabit', [App::class,'Sabit']) -> name("sabit");

//! Sabit Table
Route::get('/sabit/list', [App::class,'SabitList']) -> name("sabit.list");
Route::post('/sabit/add', [App::class,'SabitAdd']) -> name("sabit.add");
Route::post('/sabit/update/active', [App::class,'SabitUpdateActive']) -> name("sabit.update.active");
Route::post('/sabit/delete', [App::class,'SabitDelete']) -> name("sabit.delete");
Route::post('/sabit/update', [App::class,'SabitUpdate']) -> name("sabit.update");

//************* File ***************** */

//! Sabit Dosya Yükleme
Route::get('/sabit/fileUpload', [App::class,'SabitFileUpload']) -> name("sabit.fileUpload");
Route::post('/file_upload/control', [App::class,'FileUploadControl']) -> name("file.upload.control"); //! Dosya Yükleme Post
Route::post('/file_upload/multi/control', [App::class,'FileUploadMultiControl']) -> name("file.upload.multi.control"); //! Çoklu Dosya Yükleme Post


//************* Sabit Sayfalar***************** */

//! Sabit
Route::get('/error/404', [App::class,'error404']) -> name("error.404");
Route::get('/error/500', [App::class,'error500']) -> name("error.500");
Route::get('/error/company/block', [App::class,'errorCompanyBlock']) -> name("error.company.block");
Route::get('/error/order', [App::class,'errorOrder']) -> name("error.order");
Route::get('/account/block', [App::class,'accountBlock']) -> name("account.block");

