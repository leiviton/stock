(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{u1ik:function(l,n,u){"use strict";u.r(n);var e=u("CcnG"),t=function(){return function(){}}(),a=u("9AJC"),o=u("pMnS"),r=u("4GxJ"),b=u("Ip0R"),i=u("ZYCi"),s=u("gIcY"),d=u("mrSG"),c=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new e.m,n}return Object(d.d)(n,l),n.prototype.builder=function(n){return void 0===n&&(n=""),l.prototype.builder.call(this,n)},n.prototype.getFilter=function(l,n){return this.builder("admin/out?value="+l+"&field="+n).list()},n}(u("Uo/Y").a),g=function(){function l(l,n,u){this.service=l,this.modalService=n,this.toast=u,this.afterFilter=!1,this.stocks=[],this.modalReference=null,this.closeResult="",this.dateStart="",this.dateEnd="",this.link="",this.protocol="",this.company="",this.typeExport="",this.page=1,this.dataPesquisa="DATA_EMISSAO"}return l.prototype.ngOnInit=function(){this.user=JSON.parse(localStorage.getItem("user")),this.protocols=this.user.protocols,this.service.setAccessToken()},l.prototype.open=function(l){this.service.open(l,{size:"sm",backdrop:"static"})},l.prototype.close=function(){this.service.modalReference.close()},l.prototype.export=function(l,n,u,e){var t=this;this.service.builder("admin/report?start="+(l.day<10?"0"+l.day:l.day)+"/"+(l.month<10?"0"+l.month:l.month)+"/"+l.year+"&end="+(n.day<10?"0"+n.day:n.day)+"/"+(n.month<10?"0"+n.month:n.month)+"/"+n.year+"&type="+u+"&cnpj="+e).list().then(function(l){t.link=l.link,console.log(t.link),t.dateStart="",t.dateEnd="",t.typeExport="",window.open(l.link,"download"),t.toast.success("Download realizado","Sucesso"),t.close()})},l.prototype.exportComprovei=function(l,n,u){var e=this;this.service.builder("admin/comprovei?start="+(l.day<10?"0"+l.day:l.day)+"/"+(l.month<10?"0"+l.month:l.month)+"/"+l.year+"&end="+(n.day<10?"0"+n.day:n.day)+"/"+(n.month<10?"0"+n.month:n.month)+"/"+n.year+"&type="+u).list().then(function(l){e.link=l.link,console.log(e.link),e.dateStart="",e.dateEnd="",e.typeExport="",window.open(l.link,"download"),e.toast.success("Download realizado","Sucesso"),e.close()})},l.prototype.exportCompras=function(l,n,u,e){var t=this;this.service.builder("admin/report/compras?start="+(l.day<10?"0"+l.day:l.day)+"/"+(l.month<10?"0"+l.month:l.month)+"/"+l.year+"&end="+(n.day<10?"0"+n.day:n.day)+"/"+(n.month<10?"0"+n.month:n.month)+"/"+n.year+"&filial="+u+"&dataPesquisa="+e).list().then(function(l){t.link=l.link,console.log(t.link),t.dateStart="",t.dateEnd="",t.typeExport="",window.open(l.link,"download"),t.toast.success("Download realizado","Sucesso"),t.close()})},l}(),p=u("SZbH"),m=e.pb({encapsulation:0,styles:[[".modal-export[_ngcontent-%COMP%]{background:#0cc27e;color:#fff!important}.modal-export.outs-title[_ngcontent-%COMP%]{color:#fff!important} .btn-light{color:#000!important}"]],data:{}});function h(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,10,"tr",[],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Relat\xf3rio comprovei"])),(l()(),e.rb(3,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Gerar excel para envio para o comprovei"])),(l()(),e.rb(5,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Courier"])),(l()(),e.rb(7,0,null,null,3,"td",[],null,null,null,null,null)),(l()(),e.rb(8,16777216,null,null,2,"button",[["class","mb-0 btn-sm btn-link"],["ngbTooltip","Gerar"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.open(e.Bb(l.parent,32))&&t),t},null,null)),e.qb(9,212992,null,0,r.bb,[e.k,e.F,e.r,e.j,e.Q,r.cb,e.A,b.d],{ngbTooltip:[0,"ngbTooltip"]},null),(l()(),e.rb(10,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null))],function(l,n){l(n,9,0,"Gerar")},null)}function v(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,10,"tr",[],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Relat\xf3rio GNRE"])),(l()(),e.rb(3,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Gerar excel exportar GNRE do protheus"])),(l()(),e.rb(5,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Financeiro"])),(l()(),e.rb(7,0,null,null,3,"td",[],null,null,null,null,null)),(l()(),e.rb(8,16777216,null,null,2,"button",[["class","mb-0 btn-sm btn-link"],["ngbTooltip","Gerar"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.open(e.Bb(l.parent,30))&&t),t},null,null)),e.qb(9,212992,null,0,r.bb,[e.k,e.F,e.r,e.j,e.Q,r.cb,e.A,b.d],{ngbTooltip:[0,"ngbTooltip"]},null),(l()(),e.rb(10,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null))],function(l,n){l(n,9,0,"Gerar")},null)}function f(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,12,"tr",[],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Relat\xf3rio de notas entradas com centro de custo"])),(l()(),e.rb(3,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Gerar excel para exportar notas de compras do protheus"])),(l()(),e.rb(5,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Financeiro"])),(l()(),e.rb(7,0,null,null,5,"td",[],null,null,null,null,null)),(l()(),e.rb(8,16777216,null,null,4,"button",[["class","mb-0 btn-sm btn-link"],["ngbTooltip","Gerar"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==e.Bb(l,9).onClick()&&t),t},null,null)),e.qb(9,16384,null,0,i.l,[i.k,i.a,[8,null],e.F,e.k],{routerLink:[0,"routerLink"]},null),e.Cb(10,1),e.qb(11,212992,null,0,r.bb,[e.k,e.F,e.r,e.j,e.Q,r.cb,e.A,b.d],{ngbTooltip:[0,"ngbTooltip"]},null),(l()(),e.rb(12,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null))],function(l,n){var u=l(n,10,0,"/compras");l(n,9,0,u),l(n,11,0,"Gerar")},null)}function C(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,5,"div",[["class","modal-header bg-success"]],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"h3",[["class","outs-title"],["style","color: #ffffff"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Exportar GNRE"])),(l()(),e.rb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var e=!0;return"click"===n&&(e=!1!==l.component.close()&&e),e},null,null)),(l()(),e.rb(4,0,null,null,1,"span",[["aria-hidden","true"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["\xd7"])),(l()(),e.rb(6,0,null,null,61,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),e.rb(7,0,null,null,60,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var t=!0;return"submit"===n&&(t=!1!==e.Bb(l,9).onSubmit(u)&&t),"reset"===n&&(t=!1!==e.Bb(l,9).onReset()&&t),t},null,null)),e.qb(8,16384,null,0,s.q,[],null,null),e.qb(9,4210688,null,0,s.k,[[8,null],[8,null]],null,null),e.Gb(2048,null,s.c,null,[s.k]),e.qb(11,16384,null,0,s.j,[[4,s.c]],null,null),(l()(),e.rb(12,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(13,0,null,null,1,"label",[["class","label"],["for","start"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Inicial:"])),(l()(),e.rb(15,16777216,null,null,8,"input",[["class","form-control"],["id","start"],["name","start"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,17).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,17).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,17).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,18)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,18).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,18)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,18)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateStart=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,17).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(17,671744,[["d",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(18,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(21,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(23,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(24,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(25,0,null,null,1,"label",[["class","label"],["for","end"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Final:"])),(l()(),e.rb(27,16777216,null,null,8,"input",[["class","form-control"],["id","end"],["name","end"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,29).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,29).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,29).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,30)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,30).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,30)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,30)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateEnd=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,29).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(29,671744,[["d2",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(30,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(33,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(35,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(36,0,null,null,20,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(37,0,null,null,1,"label",[["class","label"],["for","protocolo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Tipo:"])),(l()(),e.rb(39,0,null,null,17,"select",[["class","form-control"],["id","protocolo"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var t=!0,a=l.component;return"change"===n&&(t=!1!==e.Bb(l,40).onChange(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,40).onTouched()&&t),"ngModelChange"===n&&(t=!1!==(a.typeExport=u)&&t),t},null,null)),e.qb(40,16384,null,0,s.n,[e.F,e.k],null,null),e.Gb(1024,null,s.g,function(l){return[l]},[s.n]),e.qb(42,671744,null,0,s.l,[[2,s.c],[8,null],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(44,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(45,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),e.qb(46,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(47,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Selecione o tipo"])),(l()(),e.rb(49,0,null,null,3,"option",[["value","avulso"]],null,null,null,null,null)),e.qb(50,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(51,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Apura\xe7\xe3o"])),(l()(),e.rb(53,0,null,null,3,"option",[["value","drs"]],null,null,null,null,null)),e.qb(54,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(55,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Avulso"])),(l()(),e.rb(57,0,null,null,8,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(58,0,null,null,1,"label",[["class","label"],["for","protocoloCo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["CNPJ Raiz:"])),(l()(),e.rb(60,0,null,null,5,"input",[["class","form-control"],["id","protocoloCn"],["name","end"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,61)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,61).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,61)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,61)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.cnpj=u)&&t),t},null,null)),e.qb(61,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.g,function(l){return[l]},[s.d]),e.qb(63,671744,null,0,s.l,[[2,s.c],[8,null],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(65,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(66,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var e=!0,t=l.component;return"click"===n&&(e=!1!==t.export(t.dateStart,t.dateEnd,t.typeExport,t.cnpj)&&e),e},null,null)),(l()(),e.Jb(-1,null,[" Gerar arquivo "]))],function(l,n){var u=n.component;l(n,21,0,"start",u.dateStart),l(n,33,0,"end",u.dateEnd),l(n,42,0,"protocolo",u.typeExport),l(n,46,0,""),l(n,47,0,""),l(n,50,0,"avulso"),l(n,51,0,"avulso"),l(n,54,0,"drs"),l(n,55,0,"drs"),l(n,63,0,"end",u.cnpj)},function(l,n){var u=n.component;l(n,7,0,e.Bb(n,11).ngClassUntouched,e.Bb(n,11).ngClassTouched,e.Bb(n,11).ngClassPristine,e.Bb(n,11).ngClassDirty,e.Bb(n,11).ngClassValid,e.Bb(n,11).ngClassInvalid,e.Bb(n,11).ngClassPending),l(n,15,0,e.Bb(n,17).disabled,e.Bb(n,23).ngClassUntouched,e.Bb(n,23).ngClassTouched,e.Bb(n,23).ngClassPristine,e.Bb(n,23).ngClassDirty,e.Bb(n,23).ngClassValid,e.Bb(n,23).ngClassInvalid,e.Bb(n,23).ngClassPending),l(n,27,0,e.Bb(n,29).disabled,e.Bb(n,35).ngClassUntouched,e.Bb(n,35).ngClassTouched,e.Bb(n,35).ngClassPristine,e.Bb(n,35).ngClassDirty,e.Bb(n,35).ngClassValid,e.Bb(n,35).ngClassInvalid,e.Bb(n,35).ngClassPending),l(n,39,0,e.Bb(n,44).ngClassUntouched,e.Bb(n,44).ngClassTouched,e.Bb(n,44).ngClassPristine,e.Bb(n,44).ngClassDirty,e.Bb(n,44).ngClassValid,e.Bb(n,44).ngClassInvalid,e.Bb(n,44).ngClassPending),l(n,60,0,e.Bb(n,65).ngClassUntouched,e.Bb(n,65).ngClassTouched,e.Bb(n,65).ngClassPristine,e.Bb(n,65).ngClassDirty,e.Bb(n,65).ngClassValid,e.Bb(n,65).ngClassInvalid,e.Bb(n,65).ngClassPending),l(n,66,0,""==u.dateEnd||""==u.dateStart||u.dateStart.length<10||u.dateEnd.length<10||""==u.typeExport)})}function B(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,20,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"label",[["class","label"],["for","protocolo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Tipo:"])),(l()(),e.rb(3,0,null,null,17,"select",[["class","form-control"],["id","protocoloC"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var t=!0,a=l.component;return"change"===n&&(t=!1!==e.Bb(l,4).onChange(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,4).onTouched()&&t),"ngModelChange"===n&&(t=!1!==(a.typeExport=u)&&t),t},null,null)),e.qb(4,16384,null,0,s.n,[e.F,e.k],null,null),e.Gb(1024,null,s.g,function(l){return[l]},[s.n]),e.qb(6,671744,null,0,s.l,[[2,s.c],[8,null],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(8,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),e.qb(10,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(11,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Selecione o tipo"])),(l()(),e.rb(13,0,null,null,3,"option",[["value","agente"]],null,null,null,null,null)),e.qb(14,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(15,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Agente"])),(l()(),e.rb(17,0,null,null,3,"option",[["value","drs"]],null,null,null,null,null)),e.qb(18,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(19,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS"]))],function(l,n){l(n,6,0,"protocolo",n.component.typeExport),l(n,10,0,""),l(n,11,0,""),l(n,14,0,"agente"),l(n,15,0,"agente"),l(n,18,0,"drs"),l(n,19,0,"drs")},function(l,n){l(n,3,0,e.Bb(n,8).ngClassUntouched,e.Bb(n,8).ngClassTouched,e.Bb(n,8).ngClassPristine,e.Bb(n,8).ngClassDirty,e.Bb(n,8).ngClassValid,e.Bb(n,8).ngClassInvalid,e.Bb(n,8).ngClassPending)})}function k(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"h3",[["class","text-white"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Exportar Comprovei"])),(l()(),e.rb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var e=!0;return"click"===n&&(e=!1!==l.component.close()&&e),e},null,null)),(l()(),e.rb(4,0,null,null,1,"span",[["aria-hidden","true"],["class","text-white"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["\xd7"])),(l()(),e.rb(6,0,null,null,33,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),e.rb(7,0,null,null,32,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var t=!0;return"submit"===n&&(t=!1!==e.Bb(l,9).onSubmit(u)&&t),"reset"===n&&(t=!1!==e.Bb(l,9).onReset()&&t),t},null,null)),e.qb(8,16384,null,0,s.q,[],null,null),e.qb(9,4210688,null,0,s.k,[[8,null],[8,null]],null,null),e.Gb(2048,null,s.c,null,[s.k]),e.qb(11,16384,null,0,s.j,[[4,s.c]],null,null),(l()(),e.rb(12,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(13,0,null,null,1,"label",[["class","label"],["for","start"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Inicial:"])),(l()(),e.rb(15,16777216,null,null,8,"input",[["class","form-control"],["id","startC"],["name","start"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,17).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,17).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,17).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,18)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,18).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,18)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,18)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateStart=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,17).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(17,671744,[["d",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(18,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(21,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(23,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(24,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(25,0,null,null,1,"label",[["class","label"],["for","end"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Final:"])),(l()(),e.rb(27,16777216,null,null,8,"input",[["class","form-control"],["id","endC"],["name","end"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,29).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,29).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,29).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,30)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,30).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,30)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,30)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateEnd=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,29).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(29,671744,[["d2",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(30,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(33,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(35,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.jb(16777216,null,null,1,null,B)),e.qb(37,16384,null,0,b.m,[e.Q,e.N],{ngIf:[0,"ngIf"]},null),(l()(),e.rb(38,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var e=!0,t=l.component;return"click"===n&&(e=!1!==t.exportComprovei(t.dateStart,t.dateEnd,t.typeExport)&&e),e},null,null)),(l()(),e.Jb(-1,null,[" Gerar arquivo "]))],function(l,n){var u=n.component;l(n,21,0,"start",u.dateStart),l(n,33,0,"end",u.dateEnd),l(n,37,0,"admin"==u.user.role||"comprovei"==u.user.role)},function(l,n){var u=n.component;l(n,7,0,e.Bb(n,11).ngClassUntouched,e.Bb(n,11).ngClassTouched,e.Bb(n,11).ngClassPristine,e.Bb(n,11).ngClassDirty,e.Bb(n,11).ngClassValid,e.Bb(n,11).ngClassInvalid,e.Bb(n,11).ngClassPending),l(n,15,0,e.Bb(n,17).disabled,e.Bb(n,23).ngClassUntouched,e.Bb(n,23).ngClassTouched,e.Bb(n,23).ngClassPristine,e.Bb(n,23).ngClassDirty,e.Bb(n,23).ngClassValid,e.Bb(n,23).ngClassInvalid,e.Bb(n,23).ngClassPending),l(n,27,0,e.Bb(n,29).disabled,e.Bb(n,35).ngClassUntouched,e.Bb(n,35).ngClassTouched,e.Bb(n,35).ngClassPristine,e.Bb(n,35).ngClassDirty,e.Bb(n,35).ngClassValid,e.Bb(n,35).ngClassInvalid,e.Bb(n,35).ngClassPending),l(n,38,0,""==u.dateEnd||""==u.dateStart||u.dateStart.length<10||u.dateEnd.length<10||""==u.typeExport)})}function q(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"h3",[["class","text-white"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Exportar notas compras"])),(l()(),e.rb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var e=!0;return"click"===n&&(e=!1!==l.component.close()&&e),e},null,null)),(l()(),e.rb(4,0,null,null,1,"span",[["aria-hidden","true"],["class","text-white"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["\xd7"])),(l()(),e.rb(6,0,null,null,89,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),e.rb(7,0,null,null,88,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var t=!0;return"submit"===n&&(t=!1!==e.Bb(l,9).onSubmit(u)&&t),"reset"===n&&(t=!1!==e.Bb(l,9).onReset()&&t),t},null,null)),e.qb(8,16384,null,0,s.q,[],null,null),e.qb(9,4210688,null,0,s.k,[[8,null],[8,null]],null,null),e.Gb(2048,null,s.c,null,[s.k]),e.qb(11,16384,null,0,s.j,[[4,s.c]],null,null),(l()(),e.rb(12,0,null,null,16,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(13,0,null,null,1,"label",[["class","label"],["for","dataCo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Filtro:"])),(l()(),e.rb(15,0,null,null,13,"select",[["class","form-control"],["id","dataCo"],["name","dataCo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var t=!0,a=l.component;return"change"===n&&(t=!1!==e.Bb(l,16).onChange(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,16).onTouched()&&t),"ngModelChange"===n&&(t=!1!==(a.dataPesquisa=u)&&t),t},null,null)),e.qb(16,16384,null,0,s.n,[e.F,e.k],null,null),e.Gb(1024,null,s.g,function(l){return[l]},[s.n]),e.qb(18,671744,null,0,s.l,[[2,s.c],[8,null],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(20,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(21,0,null,null,3,"option",[["value","DATA_EMISSAO"]],null,null,null,null,null)),e.qb(22,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(23,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DATA EMISS\xc3O"])),(l()(),e.rb(25,0,null,null,3,"option",[["value","DATA_LANCTO"]],null,null,null,null,null)),e.qb(26,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(27,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DATA LAN\xc7AMENTO"])),(l()(),e.rb(29,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(30,0,null,null,1,"label",[["class","label"],["for","startCo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Inicial:"])),(l()(),e.rb(32,16777216,null,null,8,"input",[["class","form-control"],["id","startCo"],["name","start"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,34).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,34).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,34).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,35)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,35).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,35)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,35)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateStart=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,34).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(34,671744,[["d",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(35,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(38,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(40,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(41,0,null,null,11,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(42,0,null,null,1,"label",[["class","label"],["for","endCo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Data Final:"])),(l()(),e.rb(44,16777216,null,null,8,"input",[["class","form-control"],["id","endCo"],["name","end"],["ngbDatepicker",""],["type","text"]],[[8,"disabled",0],[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"focus"],[null,"input"],[null,"change"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var t=!0,a=l.component;return"input"===n&&(t=!1!==e.Bb(l,46).manualDateChange(u.target.value)&&t),"change"===n&&(t=!1!==e.Bb(l,46).manualDateChange(u.target.value,!0)&&t),"blur"===n&&(t=!1!==e.Bb(l,46).onBlur()&&t),"input"===n&&(t=!1!==e.Bb(l,47)._handleInput(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,47).onTouched()&&t),"compositionstart"===n&&(t=!1!==e.Bb(l,47)._compositionStart()&&t),"compositionend"===n&&(t=!1!==e.Bb(l,47)._compositionEnd(u.target.value)&&t),"ngModelChange"===n&&(t=!1!==(a.dateEnd=u)&&t),"focus"===n&&(t=!1!==e.Bb(l,46).toggle()&&t),t},null,null)),e.Gb(512,null,r.rb,r.rb,[r.j,r.t]),e.qb(46,671744,[["d2",4]],0,r.z,[r.q,e.k,e.Q,e.F,e.j,e.A,r.rb,r.j,r.p,b.d],null,null),e.qb(47,16384,null,0,s.d,[e.F,e.k,[2,s.a]],null,null),e.Gb(1024,null,s.f,function(l){return[l]},[r.z]),e.Gb(1024,null,s.g,function(l,n){return[l,n]},[r.z,s.d]),e.qb(50,671744,[["dp",4]],0,s.l,[[2,s.c],[6,s.f],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(52,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(53,0,null,null,40,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),e.rb(54,0,null,null,1,"label",[["class","label"],["for","protocoloCo"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Filial:"])),(l()(),e.rb(56,0,null,null,37,"select",[["class","form-control"],["id","protocoloCo"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var t=!0,a=l.component;return"change"===n&&(t=!1!==e.Bb(l,57).onChange(u.target.value)&&t),"blur"===n&&(t=!1!==e.Bb(l,57).onTouched()&&t),"ngModelChange"===n&&(t=!1!==(a.typeExport=u)&&t),t},null,null)),e.qb(57,16384,null,0,s.n,[e.F,e.k],null,null),e.Gb(1024,null,s.g,function(l){return[l]},[s.n]),e.qb(59,671744,null,0,s.l,[[2,s.c],[8,null],[8,null],[6,s.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),e.Gb(2048,null,s.h,null,[s.l]),e.qb(61,16384,null,0,s.i,[[4,s.h]],null,null),(l()(),e.rb(62,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),e.qb(63,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(64,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Selecione a filial"])),(l()(),e.rb(66,0,null,null,3,"option",[["value","todos"]],null,null,null,null,null)),e.qb(67,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(68,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["Todos"])),(l()(),e.rb(70,0,null,null,3,"option",[["value","0100"]],null,null,null,null,null)),e.qb(71,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(72,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS ADM MATRIZ"])),(l()(),e.rb(74,0,null,null,3,"option",[["value","0101"]],null,null,null,null,null)),e.qb(75,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(76,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS COURIER"])),(l()(),e.rb(78,0,null,null,3,"option",[["value","0200"]],null,null,null,null,null)),e.qb(79,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(80,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS SUPORTMED"])),(l()(),e.rb(82,0,null,null,3,"option",[["value","0400"]],null,null,null,null,null)),e.qb(83,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(84,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS COURIER"])),(l()(),e.rb(86,0,null,null,3,"option",[["value","0600"]],null,null,null,null,null)),e.qb(87,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(88,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["YOUVITA"])),(l()(),e.rb(90,0,null,null,3,"option",[["value","0700"]],null,null,null,null,null)),e.qb(91,147456,null,0,s.m,[e.k,e.F,[2,s.n]],{value:[0,"value"]},null),e.qb(92,147456,null,0,s.s,[e.k,e.F,[8,null]],{value:[0,"value"]},null),(l()(),e.Jb(-1,null,["DRS SOLUTIONS"])),(l()(),e.rb(94,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var e=!0,t=l.component;return"click"===n&&(e=!1!==t.exportCompras(t.dateStart,t.dateEnd,t.typeExport,t.dataPesquisa)&&e),e},null,null)),(l()(),e.Jb(-1,null,[" Gerar arquivo "]))],function(l,n){var u=n.component;l(n,18,0,"dataCo",u.dataPesquisa),l(n,22,0,"DATA_EMISSAO"),l(n,23,0,"DATA_EMISSAO"),l(n,26,0,"DATA_LANCTO"),l(n,27,0,"DATA_LANCTO"),l(n,38,0,"start",u.dateStart),l(n,50,0,"end",u.dateEnd),l(n,59,0,"protocolo",u.typeExport),l(n,63,0,""),l(n,64,0,""),l(n,67,0,"todos"),l(n,68,0,"todos"),l(n,71,0,"0100"),l(n,72,0,"0100"),l(n,75,0,"0101"),l(n,76,0,"0101"),l(n,79,0,"0200"),l(n,80,0,"0200"),l(n,83,0,"0400"),l(n,84,0,"0400"),l(n,87,0,"0600"),l(n,88,0,"0600"),l(n,91,0,"0700"),l(n,92,0,"0700")},function(l,n){var u=n.component;l(n,7,0,e.Bb(n,11).ngClassUntouched,e.Bb(n,11).ngClassTouched,e.Bb(n,11).ngClassPristine,e.Bb(n,11).ngClassDirty,e.Bb(n,11).ngClassValid,e.Bb(n,11).ngClassInvalid,e.Bb(n,11).ngClassPending),l(n,15,0,e.Bb(n,20).ngClassUntouched,e.Bb(n,20).ngClassTouched,e.Bb(n,20).ngClassPristine,e.Bb(n,20).ngClassDirty,e.Bb(n,20).ngClassValid,e.Bb(n,20).ngClassInvalid,e.Bb(n,20).ngClassPending),l(n,32,0,e.Bb(n,34).disabled,e.Bb(n,40).ngClassUntouched,e.Bb(n,40).ngClassTouched,e.Bb(n,40).ngClassPristine,e.Bb(n,40).ngClassDirty,e.Bb(n,40).ngClassValid,e.Bb(n,40).ngClassInvalid,e.Bb(n,40).ngClassPending),l(n,44,0,e.Bb(n,46).disabled,e.Bb(n,52).ngClassUntouched,e.Bb(n,52).ngClassTouched,e.Bb(n,52).ngClassPristine,e.Bb(n,52).ngClassDirty,e.Bb(n,52).ngClassValid,e.Bb(n,52).ngClassInvalid,e.Bb(n,52).ngClassPending),l(n,56,0,e.Bb(n,61).ngClassUntouched,e.Bb(n,61).ngClassTouched,e.Bb(n,61).ngClassPristine,e.Bb(n,61).ngClassDirty,e.Bb(n,61).ngClassValid,e.Bb(n,61).ngClassInvalid,e.Bb(n,61).ngClassPending),l(n,94,0,""==u.dateEnd||""==u.dateStart||u.dateStart.length<10||u.dateEnd.length<10||""==u.typeExport)})}function y(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,2,"div",[["class","header bg-gradient-success pb-8 pt-5"]],null,null,null,null,null)),(l()(),e.rb(1,0,null,null,1,"div",[["class","container-fluid"]],null,null,null,null,null)),(l()(),e.rb(2,0,null,null,0,"div",[["class","header-body"]],null,null,null,null,null)),(l()(),e.rb(3,0,null,null,25,"div",[["class","container-fluid mt--7"]],null,null,null,null,null)),(l()(),e.rb(4,0,null,null,24,"div",[["class","row outs"]],null,null,null,null,null)),(l()(),e.rb(5,0,null,null,23,"div",[["class","col"]],null,null,null,null,null)),(l()(),e.rb(6,0,null,null,22,"div",[["class","card shadow"]],null,null,null,null,null)),(l()(),e.rb(7,0,null,null,3,"div",[["class","card-header border-0 d-flex justify-content-between"]],null,null,null,null,null)),(l()(),e.rb(8,0,null,null,1,"h3",[["class","mb-0"]],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Relat\xf3rios"])),(l()(),e.rb(10,0,null,null,0,"div",[["class","mb-0 col-lg-3 d-flex justify-content-end"]],null,null,null,null,null)),(l()(),e.rb(11,0,null,null,17,"div",[["class","table-responsive"]],null,null,null,null,null)),(l()(),e.rb(12,0,null,null,16,"table",[["class","table align-items-center table-flush"]],null,null,null,null,null)),(l()(),e.rb(13,0,null,null,8,"thead",[["class","thead-light"]],null,null,null,null,null)),(l()(),e.rb(14,0,null,null,7,"tr",[],null,null,null,null,null)),(l()(),e.rb(15,0,null,null,1,"th",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Relatorio"])),(l()(),e.rb(17,0,null,null,1,"th",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Descri\xe7\xe3o"])),(l()(),e.rb(19,0,null,null,1,"th",[],null,null,null,null,null)),(l()(),e.Jb(-1,null,["Departamento"])),(l()(),e.rb(21,0,null,null,0,"th",[],null,null,null,null,null)),(l()(),e.rb(22,0,null,null,6,"tbody",[],null,null,null,null,null)),(l()(),e.jb(16777216,null,null,1,null,h)),e.qb(24,16384,null,0,b.m,[e.Q,e.N],{ngIf:[0,"ngIf"]},null),(l()(),e.jb(16777216,null,null,1,null,v)),e.qb(26,16384,null,0,b.m,[e.Q,e.N],{ngIf:[0,"ngIf"]},null),(l()(),e.jb(16777216,null,null,1,null,f)),e.qb(28,16384,null,0,b.m,[e.Q,e.N],{ngIf:[0,"ngIf"]},null),(l()(),e.rb(29,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),e.jb(0,[["content",2]],null,0,null,C)),(l()(),e.rb(31,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),e.jb(0,[["comprovei",2]],null,0,null,k)),(l()(),e.rb(33,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),e.jb(0,[["compras",2]],null,0,null,q))],function(l,n){var u=n.component;l(n,24,0,"comprovei"==u.user.role||"admin"==u.user.role),l(n,26,0,"finance"==u.user.role||"admin"==u.user.role),l(n,28,0,"finance"==u.user.role||"admin"==u.user.role)},null)}function F(l){return e.Lb(0,[(l()(),e.rb(0,0,null,null,1,"app-travel",[],null,null,null,y,m)),e.qb(1,114688,null,0,g,[c,r.A,p.j],null,null)],function(l,n){l(n,1,0)},null)}var D=e.nb("app-travel",g,F,{},{},[]),S=u("t/Na"),E=u("miAi"),G=u("gFH1"),J=function(){return function(){}}(),T=u("j1ZV"),z=u("VN57");u.d(n,"ReportModuleNgFactory",function(){return x});var x=e.ob(t,[],function(l){return e.yb([e.zb(512,e.j,e.db,[[8,[a.b,o.a,D,a.a,a.o,a.k,a.l,a.m,a.n]],[3,e.j],e.y]),e.zb(4608,b.o,b.n,[e.v,[2,b.C]]),e.zb(4608,s.r,s.r,[]),e.zb(4608,r.A,r.A,[e.j,e.r,r.gb,r.B]),e.zb(4608,c,c,[S.c,i.k,p.j,E.c,r.A,G.a]),e.zb(1073742336,b.b,b.b,[]),e.zb(1073742336,s.o,s.o,[]),e.zb(1073742336,s.e,s.e,[]),e.zb(1073742336,r.u,r.u,[]),e.zb(1073742336,i.o,i.o,[[2,i.u],[2,i.k]]),e.zb(1073742336,J,J,[]),e.zb(1073742336,r.d,r.d,[]),e.zb(1073742336,r.h,r.h,[]),e.zb(1073742336,r.i,r.i,[]),e.zb(1073742336,r.m,r.m,[]),e.zb(1073742336,r.o,r.o,[]),e.zb(1073742336,r.x,r.x,[]),e.zb(1073742336,r.C,r.C,[]),e.zb(1073742336,r.G,r.G,[]),e.zb(1073742336,r.L,r.L,[]),e.zb(1073742336,r.O,r.O,[]),e.zb(1073742336,r.R,r.R,[]),e.zb(1073742336,r.W,r.W,[]),e.zb(1073742336,r.ab,r.ab,[]),e.zb(1073742336,r.db,r.db,[]),e.zb(1073742336,r.eb,r.eb,[]),e.zb(1073742336,r.D,r.D,[]),e.zb(1073742336,T.a,T.a,[]),e.zb(1073742336,z.b,z.b,[]),e.zb(1073742336,t,t,[]),e.zb(1024,i.i,function(){return[[{path:"",component:g}]]},[])])})}}]);