(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{"f+ep":function(l,n,u){"use strict";u.r(n);var t=u("CcnG"),e=function(){return function(){}}(),s=u("pMnS"),o=u("ZYCi"),i=u("gIcY"),r=u("mrSG"),a=u("Uo/Y"),c=u("AytR"),d=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new t.m,n}return Object(r.c)(n,l),n.prototype.builder=function(n){return l.prototype.builder.call(this,n)},n.prototype.login=function(l){var n=this,u=this.http.post(c.a.server_url+"/oauth/token",{grant_type:"password",client_id:c.a.client_id,client_secret:c.a.client_secret,username:l.username,password:l.password,scope:""});return this.toPromise(u).then(function(l){return n.eventEmitter.emit(),localStorage.setItem("token",l.access_token),l})},n.prototype.isAccessTokenInvalido=function(){var l=localStorage.getItem("token");return!l||this.jwtHelper.isTokenExpired(l)},n}(a.a),b=function(){function l(l,n){this.authService=l,this.router=n,this.user={username:null,password:null}}return l.prototype.ngOnInit=function(){0==this.authService.isAccessTokenInvalido()&&this.validRoute()},l.prototype.ngOnDestroy=function(){},l.prototype.login=function(l){var n=this;l.preventDefault(),this.authService.login(this.user).then(function(l){n.authService.setAccessToken(),n.authService.builder("admin/authenticated?include=company").list().then(function(l){localStorage.setItem("user",JSON.stringify(l.data)),n.validRoute()})})},l.prototype.validRoute=function(){var l=JSON.parse(localStorage.getItem("user"));0==l.first_login&&this.router.navigate(["/profile"]),this.router.navigate("admin"==l.role?["/users"]:"user_company"==l.role?["/stocks"]:"tracker"==l.role?["/tracking"]:"comprovei"==l.role?["/travel"]:["/stocks"])},l}(),p=t.qb({encapsulation:0,styles:[[".container[_ngcontent-%COMP%]{height:100vh}.container[_ngcontent-%COMP%]   .login[_ngcontent-%COMP%]{height:100vh;align-items:center}"]],data:{}});function g(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,2,"div",[["class","main-container"]],null,null,null,null,null)),(l()(),t.sb(1,16777216,null,null,1,"router-outlet",[],null,null,null,null,null)),t.rb(2,212992,null,0,o.o,[o.b,t.Q,t.j,[8,null],t.h],null,null),(l()(),t.sb(3,0,null,null,36,"div",[["class","container"]],null,null,null,null,null)),(l()(),t.sb(4,0,null,null,35,"div",[["class","row justify-content-center login"]],null,null,null,null,null)),(l()(),t.sb(5,0,null,null,34,"div",[["class","col-lg-5 col-md-7"]],null,null,null,null,null)),(l()(),t.sb(6,0,null,null,33,"div",[["class","card bg-secondary shadow border-0"]],null,null,null,null,null)),(l()(),t.sb(7,0,null,null,32,"div",[["class","card-body"]],null,null,null,null,null)),(l()(),t.sb(8,0,null,null,1,"div",[["class","text-center text-muted mb-4"]],null,null,null,null,null)),(l()(),t.sb(9,0,null,null,0,"img",[["alt",""],["height","15%"],["src","../../assets/img/brand/logo-drsgroup.jpg"],["width","15%"]],null,null,null,null,null)),(l()(),t.sb(10,0,null,null,29,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var e=!0,s=l.component;return"submit"===n&&(e=!1!==t.Cb(l,12).onSubmit(u)&&e),"reset"===n&&(e=!1!==t.Cb(l,12).onReset()&&e),"submit"===n&&(e=!1!==s.login(u)&&e),e},null,null)),t.rb(11,16384,null,0,i.q,[],null,null),t.rb(12,4210688,[["ngmyform",4]],0,i.k,[[8,null],[8,null]],null,null),t.Hb(2048,null,i.c,null,[i.k]),t.rb(14,16384,null,0,i.j,[[4,i.c]],null,null),(l()(),t.sb(15,0,null,null,10,"div",[["class","form-group mb-3"]],null,null,null,null,null)),(l()(),t.sb(16,0,null,null,9,"div",[["class","input-group input-group-alternative"]],null,null,null,null,null)),(l()(),t.sb(17,0,null,null,2,"div",[["class","input-group-prepend"]],null,null,null,null,null)),(l()(),t.sb(18,0,null,null,1,"span",[["class","input-group-text"]],null,null,null,null,null)),(l()(),t.sb(19,0,null,null,0,"i",[["class","ni ni-email-83"]],null,null,null,null,null)),(l()(),t.sb(20,0,null,null,5,"input",[["class","form-control"],["name","username"],["placeholder","Email"],["type","email"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,s=l.component;return"input"===n&&(e=!1!==t.Cb(l,21)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,21).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,21)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,21)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(s.user.username=u)&&e),e},null,null)),t.rb(21,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.d]),t.rb(23,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(25,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(26,0,null,null,10,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.sb(27,0,null,null,9,"div",[["class","input-group input-group-alternative"]],null,null,null,null,null)),(l()(),t.sb(28,0,null,null,2,"div",[["class","input-group-prepend"]],null,null,null,null,null)),(l()(),t.sb(29,0,null,null,1,"span",[["class","input-group-text"]],null,null,null,null,null)),(l()(),t.sb(30,0,null,null,0,"i",[["class","ni ni-lock-circle-open"]],null,null,null,null,null)),(l()(),t.sb(31,0,null,null,5,"input",[["class","form-control"],["name","password"],["placeholder","Senha"],["type","password"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,s=l.component;return"input"===n&&(e=!1!==t.Cb(l,32)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,32).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,32)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,32)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(s.user.password=u)&&e),e},null,null)),t.rb(32,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.d]),t.rb(34,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(36,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(37,0,null,null,2,"div",[["class","text-center"]],null,null,null,null,null)),(l()(),t.sb(38,0,null,null,1,"button",[["class","btn btn-primary btn-block my-4"],["type","submit"]],[[8,"disabled",0]],null,null,null,null)),(l()(),t.Kb(-1,null,["Acessar"]))],function(l,n){var u=n.component;l(n,2,0),l(n,23,0,"username",u.user.username),l(n,34,0,"password",u.user.password)},function(l,n){var u=n.component;l(n,10,0,t.Cb(n,14).ngClassUntouched,t.Cb(n,14).ngClassTouched,t.Cb(n,14).ngClassPristine,t.Cb(n,14).ngClassDirty,t.Cb(n,14).ngClassValid,t.Cb(n,14).ngClassInvalid,t.Cb(n,14).ngClassPending),l(n,20,0,t.Cb(n,25).ngClassUntouched,t.Cb(n,25).ngClassTouched,t.Cb(n,25).ngClassPristine,t.Cb(n,25).ngClassDirty,t.Cb(n,25).ngClassValid,t.Cb(n,25).ngClassInvalid,t.Cb(n,25).ngClassPending),l(n,31,0,t.Cb(n,36).ngClassUntouched,t.Cb(n,36).ngClassTouched,t.Cb(n,36).ngClassPristine,t.Cb(n,36).ngClassDirty,t.Cb(n,36).ngClassValid,t.Cb(n,36).ngClassInvalid,t.Cb(n,36).ngClassPending),l(n,38,0,""==u.user.password||""==u.user.username)})}function m(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,1,"app-login",[],null,null,null,g,p)),t.rb(1,245760,null,0,b,[d,o.k],null,null)],function(l,n){l(n,1,0)},null)}var h=t.ob("app-login",b,m,{},{},[]),v=u("Ip0R"),C=u("t/Na"),f=u("SZbH"),y=u("miAi"),k=u("4GxJ"),w=u("gFH1"),S=function(){return function(){}}();u.d(n,"LoginModuleNgFactory",function(){return _});var _=t.pb(e,[],function(l){return t.zb([t.Ab(512,t.j,t.db,[[8,[s.a,h]],[3,t.j],t.y]),t.Ab(4608,v.o,v.n,[t.v,[2,v.B]]),t.Ab(4608,i.r,i.r,[]),t.Ab(4608,d,d,[C.c,o.k,f.j,y.c,k.y,w.a]),t.Ab(1073742336,v.b,v.b,[]),t.Ab(1073742336,o.n,o.n,[[2,o.t],[2,o.k]]),t.Ab(1073742336,S,S,[]),t.Ab(1073742336,i.o,i.o,[]),t.Ab(1073742336,i.e,i.e,[]),t.Ab(1073742336,e,e,[]),t.Ab(1024,o.i,function(){return[[{path:"",component:b}]]},[])])})}}]);