(window.webpackJsonp=window.webpackJsonp||[]).push([[21],{"f+ep":function(l,n,u){"use strict";u.r(n);var t=u("CcnG"),e=function(){return function(){}}(),o=u("pMnS"),r=u("ZYCi"),i=u("gIcY"),s=u("mrSG"),a=u("Uo/Y"),c=u("AytR"),b=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new t.m,n}return Object(s.d)(n,l),n.prototype.builder=function(n){return l.prototype.builder.call(this,n)},n.prototype.login=function(l){var n=this,u=this.http.post(c.a.server_url+"/oauth/token",{grant_type:"password",client_id:c.a.client_id,client_secret:c.a.client_secret,username:l.username,password:l.password,scope:""});return this.toPromise(u).then(function(l){return n.eventEmitter.emit(),localStorage.setItem("token",l.access_token),l})},n.prototype.isAccessTokenInvalido=function(){var l=localStorage.getItem("token");return!l||this.jwtHelper.isTokenExpired(l)},n}(a.a),d=function(){function l(l,n){this.authService=l,this.router=n,this.user={username:null,password:null}}return l.prototype.ngOnInit=function(){0==this.authService.isAccessTokenInvalido()&&this.validRoute()},l.prototype.ngOnDestroy=function(){},l.prototype.login=function(l){var n=this;l.preventDefault(),this.authService.login(this.user).then(function(l){n.authService.setAccessToken(),n.authService.builder("admin/authenticated?include=company").list().then(function(l){localStorage.setItem("user",JSON.stringify(l.data)),n.validRoute()})})},l.prototype.validRoute=function(){var l=JSON.parse(localStorage.getItem("user"));0==l.first_login&&this.router.navigate(["/profile"]),this.router.navigate("admin"==l.role?["/users"]:"user_company"==l.role?["/stocks"]:"tracker"==l.role?["/tracking"]:"comprovei"==l.role?["/travel"]:["/stocks"])},l}(),p=t.pb({encapsulation:0,styles:[[".container[_ngcontent-%COMP%]{height:100vh}.container[_ngcontent-%COMP%]   .login[_ngcontent-%COMP%]{height:100vh;-webkit-box-align:center;align-items:center}"]],data:{}});function g(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,2,"div",[["class","main-container"]],null,null,null,null,null)),(l()(),t.rb(1,16777216,null,null,1,"router-outlet",[],null,null,null,null,null)),t.qb(2,212992,null,0,r.o,[r.b,t.Q,t.j,[8,null],t.h],null,null),(l()(),t.rb(3,0,null,null,36,"div",[["class","container"]],null,null,null,null,null)),(l()(),t.rb(4,0,null,null,35,"div",[["class","row justify-content-center login"]],null,null,null,null,null)),(l()(),t.rb(5,0,null,null,34,"div",[["class","col-lg-5 col-md-7"]],null,null,null,null,null)),(l()(),t.rb(6,0,null,null,33,"div",[["class","card bg-secondary shadow border-0"]],null,null,null,null,null)),(l()(),t.rb(7,0,null,null,32,"div",[["class","card-body"]],null,null,null,null,null)),(l()(),t.rb(8,0,null,null,1,"div",[["class","text-center text-muted mb-4"]],null,null,null,null,null)),(l()(),t.rb(9,0,null,null,0,"img",[["alt",""],["height","15%"],["src","../../assets/img/brand/logo-drsgroup.jpg"],["width","15%"]],null,null,null,null,null)),(l()(),t.rb(10,0,null,null,29,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var e=!0,o=l.component;return"submit"===n&&(e=!1!==t.Bb(l,12).onSubmit(u)&&e),"reset"===n&&(e=!1!==t.Bb(l,12).onReset()&&e),"submit"===n&&(e=!1!==o.login(u)&&e),e},null,null)),t.qb(11,16384,null,0,i.q,[],null,null),t.qb(12,4210688,[["ngmyform",4]],0,i.k,[[8,null],[8,null]],null,null),t.Gb(2048,null,i.c,null,[i.k]),t.qb(14,16384,null,0,i.j,[[4,i.c]],null,null),(l()(),t.rb(15,0,null,null,10,"div",[["class","form-group mb-3"]],null,null,null,null,null)),(l()(),t.rb(16,0,null,null,9,"div",[["class","input-group input-group-alternative"]],null,null,null,null,null)),(l()(),t.rb(17,0,null,null,2,"div",[["class","input-group-prepend"]],null,null,null,null,null)),(l()(),t.rb(18,0,null,null,1,"span",[["class","input-group-text"]],null,null,null,null,null)),(l()(),t.rb(19,0,null,null,0,"i",[["class","ni ni-email-83"]],null,null,null,null,null)),(l()(),t.rb(20,0,null,null,5,"input",[["class","form-control"],["name","username"],["placeholder","Email"],["type","email"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Bb(l,21)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Bb(l,21).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Bb(l,21)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Bb(l,21)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.user.username=u)&&e),e},null,null)),t.qb(21,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Gb(1024,null,i.g,function(l){return[l]},[i.d]),t.qb(23,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.h,null,[i.l]),t.qb(25,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.rb(26,0,null,null,10,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.rb(27,0,null,null,9,"div",[["class","input-group input-group-alternative"]],null,null,null,null,null)),(l()(),t.rb(28,0,null,null,2,"div",[["class","input-group-prepend"]],null,null,null,null,null)),(l()(),t.rb(29,0,null,null,1,"span",[["class","input-group-text"]],null,null,null,null,null)),(l()(),t.rb(30,0,null,null,0,"i",[["class","ni ni-lock-circle-open"]],null,null,null,null,null)),(l()(),t.rb(31,0,null,null,5,"input",[["class","form-control"],["name","password"],["placeholder","Senha"],["type","password"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Bb(l,32)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Bb(l,32).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Bb(l,32)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Bb(l,32)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.user.password=u)&&e),e},null,null)),t.qb(32,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Gb(1024,null,i.g,function(l){return[l]},[i.d]),t.qb(34,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.h,null,[i.l]),t.qb(36,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.rb(37,0,null,null,2,"div",[["class","text-center"]],null,null,null,null,null)),(l()(),t.rb(38,0,null,null,1,"button",[["class","btn btn-primary btn-block my-4"],["type","submit"]],[[8,"disabled",0]],null,null,null,null)),(l()(),t.Jb(-1,null,["Acessar"]))],function(l,n){var u=n.component;l(n,2,0),l(n,23,0,"username",u.user.username),l(n,34,0,"password",u.user.password)},function(l,n){var u=n.component;l(n,10,0,t.Bb(n,14).ngClassUntouched,t.Bb(n,14).ngClassTouched,t.Bb(n,14).ngClassPristine,t.Bb(n,14).ngClassDirty,t.Bb(n,14).ngClassValid,t.Bb(n,14).ngClassInvalid,t.Bb(n,14).ngClassPending),l(n,20,0,t.Bb(n,25).ngClassUntouched,t.Bb(n,25).ngClassTouched,t.Bb(n,25).ngClassPristine,t.Bb(n,25).ngClassDirty,t.Bb(n,25).ngClassValid,t.Bb(n,25).ngClassInvalid,t.Bb(n,25).ngClassPending),l(n,31,0,t.Bb(n,36).ngClassUntouched,t.Bb(n,36).ngClassTouched,t.Bb(n,36).ngClassPristine,t.Bb(n,36).ngClassDirty,t.Bb(n,36).ngClassValid,t.Bb(n,36).ngClassInvalid,t.Bb(n,36).ngClassPending),l(n,38,0,""==u.user.password||""==u.user.username)})}function m(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,1,"app-login",[],null,null,null,g,p)),t.qb(1,245760,null,0,d,[b,r.k],null,null)],function(l,n){l(n,1,0)},null)}var h=t.nb("app-login",d,m,{},{},[]),v=u("Ip0R"),f=u("t/Na"),y=u("SZbH"),C=u("miAi"),B=u("4GxJ"),k=u("gFH1"),w=function(){return function(){}}();u.d(n,"LoginModuleNgFactory",function(){return S});var S=t.ob(e,[],function(l){return t.yb([t.zb(512,t.j,t.db,[[8,[o.a,h]],[3,t.j],t.y]),t.zb(4608,v.o,v.n,[t.v,[2,v.C]]),t.zb(4608,i.r,i.r,[]),t.zb(4608,b,b,[f.c,r.k,y.j,C.c,B.A,k.a]),t.zb(1073742336,v.b,v.b,[]),t.zb(1073742336,r.n,r.n,[[2,r.t],[2,r.k]]),t.zb(1073742336,w,w,[]),t.zb(1073742336,i.o,i.o,[]),t.zb(1073742336,i.e,i.e,[]),t.zb(1073742336,e,e,[]),t.zb(1024,r.i,function(){return[[{path:"",component:d}]]},[])])})}}]);