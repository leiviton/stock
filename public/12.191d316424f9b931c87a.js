(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{NQbD:function(l,n,u){"use strict";u.r(n);var t=u("CcnG"),o=function(){return function(){}}(),e=u("pMnS"),i=u("gIcY"),a=u("Ip0R"),s=u("4GxJ"),r=u("9AJC"),c=u("ypMn"),b=u("Y7Pz"),d=u("mrSG"),p=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new t.m,n}return Object(d.c)(n,l),n.prototype.builder=function(n){return void 0===n&&(n=""),l.prototype.builder.call(this,n)},n.prototype.getStock=function(){return this.builder("admin/stock/all").list()},n.prototype.getFilter=function(l,n){return this.builder("admin/stock?value="+l+"&field="+n).list()},n}(u("Uo/Y").a),g=function(){function l(l,n,u){this.service=l,this.modalService=n,this.toast=u,this.afterFilter=!1,this.stocks=[],this.filterTipoEstoque="",this.filterDescProduto="",this.filterCodProduto="",this.filterValidade="",this.filterLote="",this.modalReference=null,this.closeResult="",this.dateStart="",this.dateEnd="",this.link="",this.protocol="",this.company="",this.companyCnpj="",this.protocoloExport="",this.page=1}return l.prototype.ngOnInit=function(){this.user=JSON.parse(localStorage.getItem("user")),this.protocols=this.user.protocols,this.service.setAccessToken(),"user_company"!=this.user.role&&this.getClients()},l.prototype.getFilter=function(l,n){var u=this;this.company="user_company"===this.user.role?this.user.company.data.id:this.company,"codigo_produto"===n&&l.length>2?(this.afterFilter=!0,this.service.builder("admin/stock/"+this.company+"?value="+l+"&field="+n+"&protocolo="+this.protocol).list().then(function(l){u.stocks=l.data,u.meta=l.meta})):l.length>3&&(this.afterFilter=!0,this.service.builder("admin/stock/"+this.company+"?value="+l+"&field="+n+"&protocolo="+this.protocol).list().then(function(l){u.stocks=l.data,u.meta=l.meta}))},l.prototype.openModal=function(l,n){this.data=l,this.type=n;var u=this.modalService.open(b.a,{size:"lg"});u.componentInstance.data=this.data,u.componentInstance.type=this.type},l.prototype.open=function(l){var n=this;this.modalReference=this.modalService.open(l,{size:"sm",backdrop:"static"}),this.modalReference.result.then(function(l){n.closeResult="Closed with: "+l},function(l){n.closeResult="Dismissed "+n.getDismissReason(l)})},l.prototype.resetFilters=function(){this.filterTipoEstoque="",this.filterDescProduto="",this.afterFilter=!1,this.getStocks(this.company)},l.prototype.getDismissReason=function(l){return l===s.a.ESC?"by pressing ESC":l===s.a.BACKDROP_CLICK?"by clicking on a backdrop":"with: "+l},l.prototype.export=function(l,n,u,t){var o=this,e={start:l,end:n,protocol:u,cnpj:t};this.service.builder("admin/stock/export").insert(e).then(function(l){o.link=l.link,o.dateStart="",o.dateEnd="",window.open(l.link,"download"),o.toast.success("Download realizado","Sucesso"),o.modalReference.close()})},l.prototype.filter=function(l,n){var u=this;this.service.builder("admin/stock/filter?start="+l+"&end="+n).list().then(function(l){u.dateStart="",u.dateEnd="",u.toast.success("Dados carregados com sucesso","Sucesso"),u.modalReference.close()})},l.prototype.getStocks=function(l){var n=this;""!=l&&this.service.builder("admin/stock/all/"+l+"?page="+this.page).list().then(function(l){0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getPage=function(l){var n=this;this.service.loading.show(),console.log("loga"),"user_company"==this.user.role?this.service.builder("admin/stock/all/"+this.user.company.data.id+"?page="+l+"&protocolo="+this.protocol).list().then(function(l){n.service.loading.hide(),0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta}):this.service.builder("admin/stock/all/"+this.company+"?page="+l).list().then(function(l){n.service.loading.hide(),0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getStocksLote=function(l){var n=this;""!=l&&this.service.builder("admin/stock/all/"+this.user.company.data.id+"?protocolo="+l).list().then(function(l){l.data.length>0?n.toast.success("Dados carregados com sucesso","Sucesso"):n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getClients=function(){var l=this;this.service.builder("admin/company").list().then(function(n){l.companies=n.data})},l}(),m=u("SZbH"),h=t.pb({encapsulation:0,styles:[[""]],data:{}});function f(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.qb(1,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(2,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(3,null,["",""]))],function(l,n){l(n,1,0,t.tb(1,"",n.context.$implicit.id,"")),l(n,2,0,t.tb(1,"",n.context.$implicit.id,""))},function(l,n){l(n,3,0,n.context.$implicit.nome)})}function v(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,17,"div",[["class","col-md-3"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,16,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var o=!0;return"submit"===n&&(o=!1!==t.Bb(l,3).onSubmit(u)&&o),"reset"===n&&(o=!1!==t.Bb(l,3).onReset()&&o),o},null,null)),t.qb(2,16384,null,0,i.r,[],null,null),t.qb(3,4210688,null,0,i.l,[[8,null],[8,null]],null,null),t.Gb(2048,null,i.c,null,[i.l]),t.qb(5,16384,null,0,i.k,[[4,i.c]],null,null),(l()(),t.rb(6,0,null,null,11,"select",[["class","form-control"],["id","company"],["name","company"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var o=!0,e=l.component;return"change"===n&&(o=!1!==t.Bb(l,7).onChange(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,7).onTouched()&&o),"ngModelChange"===n&&(o=!1!==(e.company=u)&&o),"change"===n&&(o=!1!==e.getStocks(e.company)&&o),o},null,null)),t.qb(7,16384,null,0,i.p,[t.E,t.k],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.p]),t.qb(9,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(11,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(12,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.qb(13,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(14,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(-1,null,["Selecione o cliente"])),(l()(),t.ib(16777216,null,null,1,null,f)),t.qb(17,278528,null,0,a.k,[t.P,t.M,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,9,0,"company",u.company),l(n,13,0,""),l(n,14,0,""),l(n,17,0,u.companies)},function(l,n){l(n,1,0,t.Bb(n,5).ngClassUntouched,t.Bb(n,5).ngClassTouched,t.Bb(n,5).ngClassPristine,t.Bb(n,5).ngClassDirty,t.Bb(n,5).ngClassValid,t.Bb(n,5).ngClassInvalid,t.Bb(n,5).ngClassPending),l(n,6,0,t.Bb(n,11).ngClassUntouched,t.Bb(n,11).ngClassTouched,t.Bb(n,11).ngClassPristine,t.Bb(n,11).ngClassDirty,t.Bb(n,11).ngClassValid,t.Bb(n,11).ngClassInvalid,t.Bb(n,11).ngClassPending)})}function C(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.qb(1,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(2,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(3,null,["",""]))],function(l,n){l(n,1,0,t.tb(1,"",n.context.$implicit.tip_estoque,"")),l(n,2,0,t.tb(1,"",n.context.$implicit.tip_estoque,""))},function(l,n){l(n,3,0,n.context.$implicit.des_tip_estoque)})}function B(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,12,"div",[["class","col-md-3"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,11,"select",[["class","form-control"],["id","protocol"],["name","protocol"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var o=!0,e=l.component;return"change"===n&&(o=!1!==t.Bb(l,2).onChange(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,2).onTouched()&&o),"ngModelChange"===n&&(o=!1!==(e.protocol=u)&&o),"change"===n&&(o=!1!==e.getStocksLote(e.protocol)&&o),o},null,null)),t.qb(2,16384,null,0,i.p,[t.E,t.k],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.p]),t.qb(4,671744,null,0,i.m,[[8,null],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(6,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(7,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.qb(8,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(9,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(-1,null,["Selecione o projeto"])),(l()(),t.ib(16777216,null,null,1,null,C)),t.qb(12,278528,null,0,a.k,[t.P,t.M,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,4,0,"protocol",u.protocol),l(n,8,0,""),l(n,9,0,""),l(n,12,0,u.protocols.data)},function(l,n){l(n,1,0,t.Bb(n,6).ngClassUntouched,t.Bb(n,6).ngClassTouched,t.Bb(n,6).ngClassPristine,t.Bb(n,6).ngClassDirty,t.Bb(n,6).ngClassValid,t.Bb(n,6).ngClassInvalid,t.Bb(n,6).ngClassPending)})}function k(l){return t.Lb(0,[(l()(),t.Jb(-1,null,[" Filtros "]))],null,null)}function y(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,8,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"label",[],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Desc. Protocolo"])),(l()(),t.rb(3,0,null,null,5,"input",[["class","form-control"],["name","filterTipoEstoque"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,4)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,4).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,4)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,4)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.filterTipoEstoque=u)&&o),"ngModelChange"===n&&(o=!1!==e.getFilter(e.filterTipoEstoque,"desc_tipo_estoque")&&o),o},null,null)),t.qb(4,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.d]),t.qb(6,671744,null,0,i.m,[[8,null],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(8,16384,null,0,i.j,[[4,i.i]],null,null)],function(l,n){l(n,6,0,"filterTipoEstoque",n.component.filterTipoEstoque)},function(l,n){l(n,3,0,t.Bb(n,8).ngClassUntouched,t.Bb(n,8).ngClassTouched,t.Bb(n,8).ngClassPristine,t.Bb(n,8).ngClassDirty,t.Bb(n,8).ngClassValid,t.Bb(n,8).ngClassInvalid,t.Bb(n,8).ngClassPending)})}function q(l){return t.Lb(0,[(l()(),t.ib(16777216,null,null,1,null,y)),t.qb(1,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.rb(2,0,null,null,8,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.rb(3,0,null,null,1,"label",[],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Desc. Produto"])),(l()(),t.rb(5,0,null,null,5,"input",[["class","form-control"],["name","filterDescProduto"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,6)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,6).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,6)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,6)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.filterDescProduto=u)&&o),"ngModelChange"===n&&(o=!1!==e.getFilter(e.filterDescProduto,"desc_produto")&&o),o},null,null)),t.qb(6,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.d]),t.qb(8,671744,null,0,i.m,[[8,null],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(10,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(11,0,null,null,1,"button",[["class","btn btn-outline-info"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.resetFilters()&&t),t},null,null)),(l()(),t.Jb(-1,null,["Limpar Filtros"]))],function(l,n){var u=n.component;l(n,1,0,"admin"==u.user.role||"drs_admin"==u.user.role),l(n,8,0,"filterDescProduto",u.filterDescProduto)},function(l,n){l(n,5,0,t.Bb(n,10).ngClassUntouched,t.Bb(n,10).ngClassTouched,t.Bb(n,10).ngClassPristine,t.Bb(n,10).ngClassDirty,t.Bb(n,10).ngClassValid,t.Bb(n,10).ngClassInvalid,t.Bb(n,10).ngClassPending)})}function E(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,3,"tr",[],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,2,"td",[["colspan","10"]],null,null,null,null,null)),(l()(),t.rb(2,0,null,null,1,"p",[["class","font-weight-bold"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Sem dados para exibir"]))],null,null)}function S(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,14,"tr",[],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Jb(2,null,["",""])),(l()(),t.rb(3,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Jb(4,null,["",""])),(l()(),t.rb(5,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Jb(6,null,["",""])),(l()(),t.rb(7,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Jb(8,null,["",""])),(l()(),t.rb(9,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Jb(10,null,["",""])),(l()(),t.rb(11,0,null,null,3,"td",[],null,null,null,null,null)),(l()(),t.rb(12,16777216,null,null,2,"button",[["class","btn btn-link"],["ngbTooltip","Detalhes"],["placement","top"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.openModal(l.context.$implicit,"stocks")&&t),t},null,null)),t.qb(13,212992,null,0,s.X,[t.k,t.E,t.r,t.j,t.P,s.Y,t.A,a.c],{placement:[0,"placement"],ngbTooltip:[1,"ngbTooltip"]},null),(l()(),t.rb(14,0,null,null,0,"i",[["class","fa fa-info-circle"]],null,null,null,null,null))],function(l,n){l(n,13,0,"top","Detalhes")},function(l,n){l(n,2,0,n.context.$implicit.desc_tipo_estoque),l(n,4,0,n.context.$implicit.desc_produto),l(n,6,0,n.context.$implicit.lote),l(n,8,0,n.context.$implicit.data_validade),l(n,10,0,n.context.$implicit.qtd_produto)})}function P(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,1,"ngb-pagination",[["role","navigation"],["size","sm"]],null,[[null,"pageChange"]],function(l,n,u){var t=!0,o=l.component;return"pageChange"===n&&(t=!1!==(o.meta.pagination.current_page=u)&&t),"pageChange"===n&&(t=!1!==o.getPage(u)&&t),t},r.e,r.c)),t.qb(1,573440,null,0,s.C,[s.D],{boundaryLinks:[0,"boundaryLinks"],rotate:[1,"rotate"],collectionSize:[2,"collectionSize"],maxSize:[3,"maxSize"],page:[4,"page"],pageSize:[5,"pageSize"],size:[6,"size"]},{pageChange:"pageChange"})],function(l,n){var u=n.component;l(n,1,0,!0,!0,u.meta.pagination.total,5,u.meta.pagination.current_page,u.meta.pagination.per_page,"sm")},null)}function _(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.qb(1,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(2,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(3,null,["",""]))],function(l,n){l(n,1,0,t.tb(1,"",n.context.$implicit.cnpj,"")),l(n,2,0,t.tb(1,"",n.context.$implicit.cnpj,""))},function(l,n){l(n,3,0,n.context.$implicit.nome)})}function I(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,14,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"label",[["class","label"],["for","protocolo"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Cliente:"])),(l()(),t.rb(3,0,null,null,11,"select",[["class","form-control"],["id","protocolo"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var o=!0,e=l.component;return"change"===n&&(o=!1!==t.Bb(l,4).onChange(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,4).onTouched()&&o),"ngModelChange"===n&&(o=!1!==(e.companyCnpj=u)&&o),o},null,null)),t.qb(4,16384,null,0,i.p,[t.E,t.k],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.p]),t.qb(6,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(8,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.qb(10,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(11,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(-1,null,["Selecione o cliente"])),(l()(),t.ib(16777216,null,null,1,null,_)),t.qb(14,278528,null,0,a.k,[t.P,t.M,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,6,0,"protocolo",u.companyCnpj),l(n,10,0,""),l(n,11,0,""),l(n,14,0,u.companies)},function(l,n){l(n,3,0,t.Bb(n,8).ngClassUntouched,t.Bb(n,8).ngClassTouched,t.Bb(n,8).ngClassPristine,t.Bb(n,8).ngClassDirty,t.Bb(n,8).ngClassValid,t.Bb(n,8).ngClassInvalid,t.Bb(n,8).ngClassPending)})}function M(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.qb(1,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(2,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(3,null,["",""]))],function(l,n){l(n,1,0,t.tb(1,"",n.context.$implicit.tip_estoque,"")),l(n,2,0,t.tb(1,"",n.context.$implicit.tip_estoque,""))},function(l,n){l(n,3,0,n.context.$implicit.des_tip_estoque)})}function x(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,14,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"label",[["class","label"],["for","company_select"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Projeto:"])),(l()(),t.rb(3,0,null,null,11,"select",[["class","form-control"],["id","company_select"],["name","company"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var o=!0,e=l.component;return"change"===n&&(o=!1!==t.Bb(l,4).onChange(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,4).onTouched()&&o),"ngModelChange"===n&&(o=!1!==(e.protocoloExport=u)&&o),o},null,null)),t.qb(4,16384,null,0,i.p,[t.E,t.k],null,null),t.Gb(1024,null,i.h,function(l){return[l]},[i.p]),t.qb(6,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(8,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.qb(10,147456,null,0,i.n,[t.k,t.E,[2,i.p]],{value:[0,"value"]},null),t.qb(11,147456,null,0,i.t,[t.k,t.E,[8,null]],{value:[0,"value"]},null),(l()(),t.Jb(-1,null,["Selecione o projeto"])),(l()(),t.ib(16777216,null,null,1,null,M)),t.qb(14,278528,null,0,a.k,[t.P,t.M,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,6,0,"company",u.protocoloExport),l(n,10,0,""),l(n,11,0,""),l(n,14,0,u.protocols.data)},function(l,n){l(n,3,0,t.Bb(n,8).ngClassUntouched,t.Bb(n,8).ngClassTouched,t.Bb(n,8).ngClassPristine,t.Bb(n,8).ngClassDirty,t.Bb(n,8).ngClassValid,t.Bb(n,8).ngClassInvalid,t.Bb(n,8).ngClassPending)})}function z(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"h3",[["class","outs-title"],["style","color: #ffffff"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Exportar"])),(l()(),t.rb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.context.dismiss("Cross click")&&t),t},null,null)),(l()(),t.rb(4,0,null,null,1,"span",[["aria-hidden","true"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["\xd7"])),(l()(),t.rb(6,0,null,null,33,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),t.rb(7,0,null,null,32,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var o=!0;return"submit"===n&&(o=!1!==t.Bb(l,9).onSubmit(u)&&o),"reset"===n&&(o=!1!==t.Bb(l,9).onReset()&&o),o},null,null)),t.qb(8,16384,null,0,i.r,[],null,null),t.qb(9,4210688,null,0,i.l,[[8,null],[8,null]],null,null),t.Gb(2048,null,i.c,null,[i.l]),t.qb(11,16384,null,0,i.k,[[4,i.c]],null,null),(l()(),t.rb(12,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(13,0,null,null,1,"label",[["class","label"],["for","start"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Data Inicial"])),(l()(),t.rb(15,0,null,null,7,"input",[["class","form-control"],["id","start"],["name","start"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,16)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,16).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,16)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,16)._compositionEnd(u.target.value)&&o),"input"===n&&(o=!1!==t.Bb(l,17)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,17).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,17)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,17)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.dateStart=u)&&o),o},null,null)),t.qb(16,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.qb(17,4866048,null,0,c.a,[t.k,t.E,[2,i.a]],{imask:[0,"imask"]},null),t.Eb(18,{mask:0}),t.Gb(1024,null,i.h,function(l,n){return[l,n]},[i.d,c.a]),t.qb(20,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(22,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(23,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(24,0,null,null,1,"label",[["class","label"],["for","end"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Data Final"])),(l()(),t.rb(26,0,null,null,7,"input",[["class","form-control"],["id","end"],["name","end"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,27)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,27).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,27)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,27)._compositionEnd(u.target.value)&&o),"input"===n&&(o=!1!==t.Bb(l,28)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,28).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,28)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,28)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.dateEnd=u)&&o),o},null,null)),t.qb(27,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.qb(28,4866048,null,0,c.a,[t.k,t.E,[2,i.a]],{imask:[0,"imask"]},null),t.Eb(29,{mask:0}),t.Gb(1024,null,i.h,function(l,n){return[l,n]},[i.d,c.a]),t.qb(31,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(33,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.ib(16777216,null,null,1,null,I)),t.qb(35,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.ib(16777216,null,null,1,null,x)),t.qb(37,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.rb(38,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var t=!0,o=l.component;return"click"===n&&(t=!1!==o.export(o.dateStart,o.dateEnd,o.protocoloExport,o.companyCnpj)&&t),t},null,null)),(l()(),t.Jb(-1,null,["Gerar arquivo"]))],function(l,n){var u=n.component,t=l(n,18,0,"00/00/0000");l(n,17,0,t),l(n,20,0,"start",u.dateStart);var o=l(n,29,0,"00/00/0000");l(n,28,0,o),l(n,31,0,"end",u.dateEnd),l(n,35,0,"admin"==u.user.role||"drs_admin"==u.user.role),l(n,37,0,"user_company"==u.user.role)},function(l,n){var u=n.component;l(n,7,0,t.Bb(n,11).ngClassUntouched,t.Bb(n,11).ngClassTouched,t.Bb(n,11).ngClassPristine,t.Bb(n,11).ngClassDirty,t.Bb(n,11).ngClassValid,t.Bb(n,11).ngClassInvalid,t.Bb(n,11).ngClassPending),l(n,15,0,t.Bb(n,22).ngClassUntouched,t.Bb(n,22).ngClassTouched,t.Bb(n,22).ngClassPristine,t.Bb(n,22).ngClassDirty,t.Bb(n,22).ngClassValid,t.Bb(n,22).ngClassInvalid,t.Bb(n,22).ngClassPending),l(n,26,0,t.Bb(n,33).ngClassUntouched,t.Bb(n,33).ngClassTouched,t.Bb(n,33).ngClassPristine,t.Bb(n,33).ngClassDirty,t.Bb(n,33).ngClassValid,t.Bb(n,33).ngClassInvalid,t.Bb(n,33).ngClassPending),l(n,38,0,""==u.dateEnd||""==u.dateStart||"user_company"==u.user.role&&""==u.protocoloExport||"admin"==u.user.role&&""==u.companyCnpj)})}function J(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"h3",[["class","text-white"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Pesquisar"])),(l()(),t.rb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.context.dismiss("Cross click")&&t),t},null,null)),(l()(),t.rb(4,0,null,null,1,"span",[["aria-hidden","true"],["class","text-white"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["\xd7"])),(l()(),t.rb(6,0,null,null,29,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),t.rb(7,0,null,null,28,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var o=!0;return"submit"===n&&(o=!1!==t.Bb(l,9).onSubmit(u)&&o),"reset"===n&&(o=!1!==t.Bb(l,9).onReset()&&o),o},null,null)),t.qb(8,16384,null,0,i.r,[],null,null),t.qb(9,4210688,null,0,i.l,[[8,null],[8,null]],null,null),t.Gb(2048,null,i.c,null,[i.l]),t.qb(11,16384,null,0,i.k,[[4,i.c]],null,null),(l()(),t.rb(12,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(13,0,null,null,1,"label",[["class","label"],["for","startS"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Data Inicial"])),(l()(),t.rb(15,0,null,null,7,"input",[["class","form-control"],["id","startS"],["name","start"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,16)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,16).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,16)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,16)._compositionEnd(u.target.value)&&o),"input"===n&&(o=!1!==t.Bb(l,17)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,17).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,17)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,17)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.dateStart=u)&&o),o},null,null)),t.qb(16,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.qb(17,4866048,null,0,c.a,[t.k,t.E,[2,i.a]],{imask:[0,"imask"]},null),t.Eb(18,{mask:0}),t.Gb(1024,null,i.h,function(l,n){return[l,n]},[i.d,c.a]),t.qb(20,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(22,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(23,0,null,null,10,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.rb(24,0,null,null,1,"label",[["class","label"],["for","endS"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Data Final"])),(l()(),t.rb(26,0,null,null,7,"input",[["class","form-control"],["id","endS"],["name","end"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var o=!0,e=l.component;return"input"===n&&(o=!1!==t.Bb(l,27)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,27).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,27)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,27)._compositionEnd(u.target.value)&&o),"input"===n&&(o=!1!==t.Bb(l,28)._handleInput(u.target.value)&&o),"blur"===n&&(o=!1!==t.Bb(l,28).onTouched()&&o),"compositionstart"===n&&(o=!1!==t.Bb(l,28)._compositionStart()&&o),"compositionend"===n&&(o=!1!==t.Bb(l,28)._compositionEnd(u.target.value)&&o),"ngModelChange"===n&&(o=!1!==(e.dateEnd=u)&&o),o},null,null)),t.qb(27,16384,null,0,i.d,[t.E,t.k,[2,i.a]],null,null),t.qb(28,4866048,null,0,c.a,[t.k,t.E,[2,i.a]],{imask:[0,"imask"]},null),t.Eb(29,{mask:0}),t.Gb(1024,null,i.h,function(l,n){return[l,n]},[i.d,c.a]),t.qb(31,671744,null,0,i.m,[[2,i.c],[8,null],[8,null],[6,i.h]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Gb(2048,null,i.i,null,[i.m]),t.qb(33,16384,null,0,i.j,[[4,i.i]],null,null),(l()(),t.rb(34,0,null,null,1,"button",[["class","btn btn-block btn-primary primary-green"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var t=!0,o=l.component;return"click"===n&&(t=!1!==o.filter(o.dateStart,o.dateEnd)&&t),t},null,null)),(l()(),t.Jb(-1,null,["Pesquisar"]))],function(l,n){var u=n.component,t=l(n,18,0,"00/00/0000");l(n,17,0,t),l(n,20,0,"start",u.dateStart);var o=l(n,29,0,"00/00/0000");l(n,28,0,o),l(n,31,0,"end",u.dateEnd)},function(l,n){var u=n.component;l(n,7,0,t.Bb(n,11).ngClassUntouched,t.Bb(n,11).ngClassTouched,t.Bb(n,11).ngClassPristine,t.Bb(n,11).ngClassDirty,t.Bb(n,11).ngClassValid,t.Bb(n,11).ngClassInvalid,t.Bb(n,11).ngClassPending),l(n,15,0,t.Bb(n,22).ngClassUntouched,t.Bb(n,22).ngClassTouched,t.Bb(n,22).ngClassPristine,t.Bb(n,22).ngClassDirty,t.Bb(n,22).ngClassValid,t.Bb(n,22).ngClassInvalid,t.Bb(n,22).ngClassPending),l(n,26,0,t.Bb(n,33).ngClassUntouched,t.Bb(n,33).ngClassTouched,t.Bb(n,33).ngClassPristine,t.Bb(n,33).ngClassDirty,t.Bb(n,33).ngClassValid,t.Bb(n,33).ngClassInvalid,t.Bb(n,33).ngClassPending),l(n,34,0,""==u.dateEnd||""==u.dateStart)})}function T(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,2,"div",[["class","header bg-gradient-success pb-8 pt-5"]],null,null,null,null,null)),(l()(),t.rb(1,0,null,null,1,"div",[["class","container-fluid"]],null,null,null,null,null)),(l()(),t.rb(2,0,null,null,0,"div",[["class","header-body"]],null,null,null,null,null)),(l()(),t.rb(3,0,null,null,48,"div",[["class","container-fluid mt--7"]],null,null,null,null,null)),(l()(),t.rb(4,0,null,null,47,"div",[["class","row stocks"]],null,null,null,null,null)),(l()(),t.rb(5,0,null,null,46,"div",[["class","col"]],null,null,null,null,null)),(l()(),t.rb(6,0,null,null,45,"div",[["class","card shadow"]],null,null,null,null,null)),(l()(),t.rb(7,0,null,null,19,"div",[["class","card-header border-0 d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.rb(8,0,null,null,1,"h3",[["class","mb-0"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Estoque"])),(l()(),t.ib(16777216,null,null,1,null,v)),t.qb(11,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.ib(16777216,null,null,1,null,B)),t.qb(13,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.rb(14,0,null,null,12,"div",[["class","mb-0 col-lg-3 d-flex justify-content-end"]],null,null,null,null,null)),(l()(),t.rb(15,0,null,null,2,"button",[["class","mb-0 mr-1 btn-sm btn-link"]],null,[[null,"click"]],function(l,n,u){var o=!0;return"click"===n&&(o=!1!==l.component.open(t.Bb(l,55))&&o),o},null,null)),(l()(),t.rb(16,0,null,null,0,"i",[["class","fas fa-search"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,[" Pesquisar"])),(l()(),t.rb(18,0,null,null,2,"button",[["class","mb-0 btn-sm btn-link"]],null,[[null,"click"]],function(l,n,u){var o=!0;return"click"===n&&(o=!1!==l.component.open(t.Bb(l,53))&&o),o},null,null)),(l()(),t.rb(19,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,[" Exportar"])),(l()(),t.rb(21,16777216,null,null,3,"button",[["class","mb-0 btn-sm btn-filter btn-link"],["placement","bottom"],["popoverClass","custom-popover"],["type","button"]],null,null,null,null,null)),t.qb(22,737280,null,0,s.F,[t.k,t.E,t.r,t.j,t.P,s.G,t.A,a.c],{autoClose:[0,"autoClose"],ngbPopover:[1,"ngbPopover"],popoverTitle:[2,"popoverTitle"],placement:[3,"placement"],popoverClass:[4,"popoverClass"]},null),(l()(),t.rb(23,0,null,null,0,"i",[["class","fa fa-filter"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,[" Filtros "])),(l()(),t.ib(0,[["popTitle",2]],null,0,null,k)),(l()(),t.ib(0,[["popContent",2]],null,0,null,q)),(l()(),t.rb(27,0,null,null,20,"div",[["class","table-responsive"]],null,null,null,null,null)),(l()(),t.rb(28,0,null,null,19,"table",[["class","table align-items-center table-flush"]],null,null,null,null,null)),(l()(),t.rb(29,0,null,null,13,"thead",[["class","thead-light"]],null,null,null,null,null)),(l()(),t.rb(30,0,null,null,12,"tr",[],null,null,null,null,null)),(l()(),t.rb(31,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Des.Protocolo"])),(l()(),t.rb(33,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Des.Produto"])),(l()(),t.rb(35,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Lote"])),(l()(),t.rb(37,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Validade"])),(l()(),t.rb(39,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["Qtd.Disponivel"])),(l()(),t.rb(41,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Jb(-1,null,["A\xe7\xf5es"])),(l()(),t.rb(43,0,null,null,4,"tbody",[],null,null,null,null,null)),(l()(),t.ib(16777216,null,null,1,null,E)),t.qb(45,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.ib(16777216,null,null,1,null,S)),t.qb(47,278528,null,0,a.k,[t.P,t.M,t.t],{ngForOf:[0,"ngForOf"]},null),(l()(),t.rb(48,0,null,null,3,"div",[["class","container-pagination d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.rb(49,0,null,null,2,"div",[["class","col-md-6"]],null,null,null,null,null)),(l()(),t.ib(16777216,null,null,1,null,P)),t.qb(51,16384,null,0,a.l,[t.P,t.M],{ngIf:[0,"ngIf"]},null),(l()(),t.rb(52,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),t.ib(0,[["content",2]],null,0,null,z)),(l()(),t.rb(54,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),t.ib(0,[["search",2]],null,0,null,J))],function(l,n){var u=n.component;l(n,11,0,"user_company"!=u.user.role),l(n,13,0,"user_company"==u.user.role),l(n,22,0,"outside",t.Bb(n,26),t.Bb(n,25),"bottom","custom-popover"),l(n,45,0,0==u.stocks.length),l(n,47,0,u.stocks),l(n,51,0,u.stocks.length>0&&0==u.afterFilter)},null)}function D(l){return t.Lb(0,[(l()(),t.rb(0,0,null,null,1,"app-tables",[],null,null,null,T,h)),t.qb(1,114688,null,0,g,[p,s.y,m.j],null,null)],function(l,n){l(n,1,0)},null)}var j=t.nb("app-tables",g,D,{},{},[]),w=u("t/Na"),F=u("ZYCi"),G=u("miAi"),L=function(){return function(){}}(),$=u("j1ZV"),V=u("atAv");u.d(n,"StocksModuleNgFactory",function(){return R});var R=t.ob(o,[],function(l){return t.yb([t.zb(512,t.j,t.cb,[[8,[e.a,j,r.a,r.b,r.k,r.g,r.h,r.i,r.j]],[3,t.j],t.y]),t.zb(4608,a.n,a.m,[t.v,[2,a.A]]),t.zb(4608,i.s,i.s,[]),t.zb(4608,s.y,s.y,[t.j,t.r,s.cb,s.z]),t.zb(4608,p,p,[w.c,F.k,m.j,G.c,s.y]),t.zb(1073742336,a.b,a.b,[]),t.zb(1073742336,F.n,F.n,[[2,F.t],[2,F.k]]),t.zb(1073742336,L,L,[]),t.zb(1073742336,s.d,s.d,[]),t.zb(1073742336,s.h,s.h,[]),t.zb(1073742336,s.i,s.i,[]),t.zb(1073742336,s.m,s.m,[]),t.zb(1073742336,s.o,s.o,[]),t.zb(1073742336,i.q,i.q,[]),t.zb(1073742336,i.e,i.e,[]),t.zb(1073742336,s.t,s.t,[]),t.zb(1073742336,s.w,s.w,[]),t.zb(1073742336,s.A,s.A,[]),t.zb(1073742336,s.E,s.E,[]),t.zb(1073742336,s.H,s.H,[]),t.zb(1073742336,s.K,s.K,[]),t.zb(1073742336,s.N,s.N,[]),t.zb(1073742336,s.S,s.S,[]),t.zb(1073742336,s.W,s.W,[]),t.zb(1073742336,s.Z,s.Z,[]),t.zb(1073742336,s.ab,s.ab,[]),t.zb(1073742336,s.B,s.B,[]),t.zb(1073742336,$.a,$.a,[]),t.zb(1073742336,V.a,V.a,[]),t.zb(1073742336,o,o,[]),t.zb(1024,F.i,function(){return[[{path:"",component:g}]]},[])])})}}]);