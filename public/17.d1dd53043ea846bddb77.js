(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{iN4E:function(l,n,u){"use strict";u.r(n);var t=u("CcnG"),e=function(){return function(){}}(),o=u("pMnS"),s=u("9AJC"),a=u("4GxJ"),i=u("gIcY"),r=u("VN57"),c=u("Ip0R"),b=u("Y7Pz"),d=u("mrSG"),p=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new t.m,n}return Object(d.d)(n,l),n.prototype.builder=function(n){return void 0===n&&(n=""),l.prototype.builder.call(this,n)},n.prototype.getFilter=function(l,n){return this.builder("admin/out?value="+l+"&field="+n).list()},n}(u("Uo/Y").a),g=function(){function l(l,n,u){this.service=l,this.modalService=n,this.toast=u,this.afterFilter=!1,this.stocks=[],this.filterTipoEstoque="",this.filterEnvio="",this.filterDestino="",this.filterCentro="",this.filterDescProduto="",this.filterLote="",this.modalReference=null,this.closeResult="",this.dateStart="",this.dateEnd="",this.link="",this.protocol="",this.company="",this.typeExport="",this.protocoloExport="",this.page=1}return l.prototype.ngOnInit=function(){this.user=JSON.parse(localStorage.getItem("user")),this.protocols=this.user.protocols,this.service.setAccessToken(),this.getAgents()},l.prototype.openModal=function(l,n){this.data=l,this.type=n;var u=this.modalService.open(b.a,{size:"sm"});u.componentInstance.data=this.data,u.componentInstance.type=this.type},l.prototype.open=function(l){var n=this;this.modalReference=this.modalService.open(l,{size:"sm",backdrop:"static"}),this.modalReference.result.then(function(l){n.closeResult="Closed with: "+l},function(l){n.closeResult="Dismissed "+n.getDismissReason(l)})},l.prototype.getDismissReason=function(l){return l===a.a.ESC?"by pressing ESC":l===a.a.BACKDROP_CLICK?"by clicking on a backdrop":"with: "+l},l.prototype.export=function(l,n,u){var t=this;this.service.builder("admin/comprovei?start="+l+"&end="+n+"&type="+u).list().then(function(l){t.link=l.link,t.dateStart="",t.dateEnd="",window.open(l.link,"download"),t.toast.success("Download realizado","Sucesso"),t.modalReference.close()})},l.prototype.getAgents=function(){var l=this;this.service.builder("admin/comprovei/agent").list().then(function(n){l.companies=n.data})},l}(),h=u("SZbH"),m=t.qb({encapsulation:0,styles:[[".modal-export[_ngcontent-%COMP%]{background:#0cc27e;color:#fff!important}.modal-export.outs-title[_ngcontent-%COMP%]{color:#fff!important}"]],data:{}});function C(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"tr",[],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,2,"td",[["colspan","12"]],null,null,null,null,null)),(l()(),t.sb(2,0,null,null,1,"p",[["class","font-weight-bold"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Clique em exportar para selecionar periodo"]))],null,null)}function f(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,1,"ngb-pagination",[["role","navigation"],["size","sm"]],null,[[null,"pageChange"]],function(l,n,u){var t=!0,e=l.component;return"pageChange"===n&&(t=!1!==(e.meta.pagination.current_page=u)&&t),"pageChange"===n&&(t=!1!==e.getPage(u)&&t),t},s.g,s.d)),t.rb(1,573440,null,0,a.C,[a.D],{boundaryLinks:[0,"boundaryLinks"],rotate:[1,"rotate"],collectionSize:[2,"collectionSize"],maxSize:[3,"maxSize"],page:[4,"page"],pageSize:[5,"pageSize"],size:[6,"size"]},{pageChange:"pageChange"})],function(l,n){var u=n.component;l(n,1,0,!0,!0,u.meta.pagination.total,5,u.meta.pagination.current_page,u.meta.pagination.per_page,"sm")},null)}function v(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,20,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"label",[["class","label"],["for","protocolo"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Tipo:"])),(l()(),t.sb(3,0,null,null,17,"select",[["class","form-control"],["id","protocolo"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var e=!0,o=l.component;return"change"===n&&(e=!1!==t.Cb(l,4).onChange(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,4).onTouched()&&e),"ngModelChange"===n&&(e=!1!==(o.typeExport=u)&&e),e},null,null)),t.rb(4,16384,null,0,i.n,[t.F,t.k],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.n]),t.rb(6,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(8,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.rb(10,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(11,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Selecione o tipo"])),(l()(),t.sb(13,0,null,null,3,"option",[["value","agente"]],null,null,null,null,null)),t.rb(14,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(15,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Agente"])),(l()(),t.sb(17,0,null,null,3,"option",[["value","drs"]],null,null,null,null,null)),t.rb(18,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(19,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["DRS"]))],function(l,n){l(n,6,0,"protocolo",n.component.typeExport),l(n,10,0,""),l(n,11,0,""),l(n,14,0,"agente"),l(n,15,0,"agente"),l(n,18,0,"drs"),l(n,19,0,"drs")},function(l,n){l(n,3,0,t.Cb(n,8).ngClassUntouched,t.Cb(n,8).ngClassTouched,t.Cb(n,8).ngClassPristine,t.Cb(n,8).ngClassDirty,t.Cb(n,8).ngClassValid,t.Cb(n,8).ngClassInvalid,t.Cb(n,8).ngClassPending)})}function y(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"h3",[["class","text-white"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Exportar"])),(l()(),t.sb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.context.dismiss("Cross click")&&t),t},null,null)),(l()(),t.sb(4,0,null,null,1,"span",[["aria-hidden","true"],["class","text-white"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["\xd7"])),(l()(),t.sb(6,0,null,null,31,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),t.sb(7,0,null,null,30,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var e=!0;return"submit"===n&&(e=!1!==t.Cb(l,9).onSubmit(u)&&e),"reset"===n&&(e=!1!==t.Cb(l,9).onReset()&&e),e},null,null)),t.rb(8,16384,null,0,i.q,[],null,null),t.rb(9,4210688,null,0,i.k,[[8,null],[8,null]],null,null),t.Hb(2048,null,i.c,null,[i.k]),t.rb(11,16384,null,0,i.j,[[4,i.c]],null,null),(l()(),t.sb(12,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.sb(13,0,null,null,1,"label",[["class","label"],["for","start"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Data Inicial:"])),(l()(),t.sb(15,0,null,null,7,"input",[["class","form-control"],["id","start"],["name","start"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Cb(l,16)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,16).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,16)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,16)._compositionEnd(u.target.value)&&e),"input"===n&&(e=!1!==t.Cb(l,17)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,17).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,17)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,17)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.dateStart=u)&&e),e},null,null)),t.rb(16,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.rb(17,4866048,null,0,r.a,[t.k,t.F,[2,i.a]],{imask:[0,"imask"]},null),t.Fb(18,{mask:0}),t.Hb(1024,null,i.g,function(l,n){return[l,n]},[i.d,r.a]),t.rb(20,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(22,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(23,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.sb(24,0,null,null,1,"label",[["class","label"],["for","end"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Data Final:"])),(l()(),t.sb(26,0,null,null,7,"input",[["class","form-control"],["id","end"],["name","end"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Cb(l,27)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,27).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,27)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,27)._compositionEnd(u.target.value)&&e),"input"===n&&(e=!1!==t.Cb(l,28)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,28).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,28)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,28)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.dateEnd=u)&&e),e},null,null)),t.rb(27,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.rb(28,4866048,null,0,r.a,[t.k,t.F,[2,i.a]],{imask:[0,"imask"]},null),t.Fb(29,{mask:0}),t.Hb(1024,null,i.g,function(l,n){return[l,n]},[i.d,r.a]),t.rb(31,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(33,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.jb(16777216,null,null,1,null,v)),t.rb(35,16384,null,0,c.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(36,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var t=!0,e=l.component;return"click"===n&&(t=!1!==e.export(e.dateStart,e.dateEnd,e.typeExport)&&t),t},null,null)),(l()(),t.Kb(-1,null,[" Gerar arquivo "]))],function(l,n){var u=n.component,t=l(n,18,0,"00/00/0000");l(n,17,0,t),l(n,20,0,"start",u.dateStart);var e=l(n,29,0,"00/00/0000");l(n,28,0,e),l(n,31,0,"end",u.dateEnd),l(n,35,0,"admin"==u.user.role||"comprovei"==u.user.role)},function(l,n){var u=n.component;l(n,7,0,t.Cb(n,11).ngClassUntouched,t.Cb(n,11).ngClassTouched,t.Cb(n,11).ngClassPristine,t.Cb(n,11).ngClassDirty,t.Cb(n,11).ngClassValid,t.Cb(n,11).ngClassInvalid,t.Cb(n,11).ngClassPending),l(n,15,0,t.Cb(n,22).ngClassUntouched,t.Cb(n,22).ngClassTouched,t.Cb(n,22).ngClassPristine,t.Cb(n,22).ngClassDirty,t.Cb(n,22).ngClassValid,t.Cb(n,22).ngClassInvalid,t.Cb(n,22).ngClassPending),l(n,26,0,t.Cb(n,33).ngClassUntouched,t.Cb(n,33).ngClassTouched,t.Cb(n,33).ngClassPristine,t.Cb(n,33).ngClassDirty,t.Cb(n,33).ngClassValid,t.Cb(n,33).ngClassInvalid,t.Cb(n,33).ngClassPending),l(n,36,0,""==u.dateEnd||""==u.dateStart||u.dateStart.length<10||u.dateEnd.length<10||""==u.typeExport)})}function k(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,2,"div",[["class","header bg-gradient-success pb-8 pt-5"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"div",[["class","container-fluid"]],null,null,null,null,null)),(l()(),t.sb(2,0,null,null,0,"div",[["class","header-body"]],null,null,null,null,null)),(l()(),t.sb(3,0,null,null,27,"div",[["class","container-fluid mt--7"]],null,null,null,null,null)),(l()(),t.sb(4,0,null,null,26,"div",[["class","row outs"]],null,null,null,null,null)),(l()(),t.sb(5,0,null,null,25,"div",[["class","col"]],null,null,null,null,null)),(l()(),t.sb(6,0,null,null,24,"div",[["class","card shadow"]],null,null,null,null,null)),(l()(),t.sb(7,0,null,null,6,"div",[["class","card-header border-0 d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.sb(8,0,null,null,1,"h3",[["class","mb-0"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Rotas"])),(l()(),t.sb(10,0,null,null,3,"div",[["class","mb-0 col-lg-3 d-flex justify-content-end"]],null,null,null,null,null)),(l()(),t.sb(11,0,null,null,2,"button",[["class","mb-0 btn-sm btn-link"]],null,[[null,"click"]],function(l,n,u){var e=!0;return"click"===n&&(e=!1!==l.component.open(t.Cb(l,32))&&e),e},null,null)),(l()(),t.sb(12,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,[" Exportar "])),(l()(),t.sb(14,0,null,null,12,"div",[["class","table-responsive"]],null,null,null,null,null)),(l()(),t.sb(15,0,null,null,11,"table",[["class","table align-items-center table-flush"]],null,null,null,null,null)),(l()(),t.sb(16,0,null,null,7,"thead",[["class","thead-light"]],null,null,null,null,null)),(l()(),t.sb(17,0,null,null,6,"tr",[],null,null,null,null,null)),(l()(),t.sb(18,0,null,null,0,"th",[["class","text-center"],["scope","col"]],null,null,null,null,null)),(l()(),t.sb(19,0,null,null,0,"th",[["class","text-center"],["scope","col"]],null,null,null,null,null)),(l()(),t.sb(20,0,null,null,0,"th",[["class","text-center"],["scope","col"]],null,null,null,null,null)),(l()(),t.sb(21,0,null,null,0,"th",[["class","text-center"],["scope","col"]],null,null,null,null,null)),(l()(),t.sb(22,0,null,null,0,"th",[["class","text-center"],["scope","col"]],null,null,null,null,null)),(l()(),t.sb(23,0,null,null,0,"th",[],null,null,null,null,null)),(l()(),t.sb(24,0,null,null,2,"tbody",[],null,null,null,null,null)),(l()(),t.jb(16777216,null,null,1,null,C)),t.rb(26,16384,null,0,c.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(27,0,null,null,3,"div",[["class","container-pagination d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.sb(28,0,null,null,2,"div",[["class","col-md-6"]],null,null,null,null,null)),(l()(),t.jb(16777216,null,null,1,null,f)),t.rb(30,16384,null,0,c.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(31,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),t.jb(0,[["content",2]],null,0,null,y))],function(l,n){var u=n.component;l(n,26,0,0==u.stocks.length),l(n,30,0,u.stocks.length>0&&0==u.afterFilter)},null)}function A(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,1,"app-travel",[],null,null,null,k,m)),t.rb(1,114688,null,0,g,[p,a.y,h.j],null,null)],function(l,n){l(n,1,0)},null)}var S=t.ob("app-travel",g,A,{},{},[]),x=u("t/Na"),E=u("ZYCi"),w=u("miAi"),I=u("gFH1"),M=function(){return function(){}}(),F=u("j1ZV");u.d(n,"TravelModuleNgFactory",function(){return _});var _=t.pb(e,[],function(l){return t.zb([t.Ab(512,t.j,t.db,[[8,[o.a,S,s.a,s.b,s.m,s.i,s.j,s.k,s.l]],[3,t.j],t.y]),t.Ab(4608,c.o,c.n,[t.v,[2,c.B]]),t.Ab(4608,i.r,i.r,[]),t.Ab(4608,a.y,a.y,[t.j,t.r,a.eb,a.z]),t.Ab(4608,p,p,[x.c,E.k,h.j,w.c,a.y,I.a]),t.Ab(1073742336,c.b,c.b,[]),t.Ab(1073742336,E.n,E.n,[[2,E.t],[2,E.k]]),t.Ab(1073742336,M,M,[]),t.Ab(1073742336,i.o,i.o,[]),t.Ab(1073742336,i.e,i.e,[]),t.Ab(1073742336,a.d,a.d,[]),t.Ab(1073742336,a.h,a.h,[]),t.Ab(1073742336,a.i,a.i,[]),t.Ab(1073742336,a.m,a.m,[]),t.Ab(1073742336,a.o,a.o,[]),t.Ab(1073742336,a.t,a.t,[]),t.Ab(1073742336,a.w,a.w,[]),t.Ab(1073742336,a.A,a.A,[]),t.Ab(1073742336,a.E,a.E,[]),t.Ab(1073742336,a.J,a.J,[]),t.Ab(1073742336,a.M,a.M,[]),t.Ab(1073742336,a.P,a.P,[]),t.Ab(1073742336,a.U,a.U,[]),t.Ab(1073742336,a.Y,a.Y,[]),t.Ab(1073742336,a.bb,a.bb,[]),t.Ab(1073742336,a.cb,a.cb,[]),t.Ab(1073742336,a.B,a.B,[]),t.Ab(1073742336,F.a,F.a,[]),t.Ab(1073742336,r.b,r.b,[]),t.Ab(1073742336,e,e,[]),t.Ab(1024,E.i,function(){return[[{path:"",component:g}]]},[])])})}}]);