(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{NQbD:function(l,n,u){"use strict";u.r(n);var t=u("CcnG"),e=function(){return function(){}}(),o=u("pMnS"),i=u("gIcY"),s=u("Ip0R"),a=u("4GxJ"),r=u("9AJC"),c=u("Y7Pz"),b=u("mrSG"),d=function(l){function n(){var n=null!==l&&l.apply(this,arguments)||this;return n.eventEmitter=new t.m,n}return Object(b.c)(n,l),n.prototype.builder=function(n){return void 0===n&&(n=""),l.prototype.builder.call(this,n)},n.prototype.getStock=function(){return this.builder("admin/stock/all").list()},n.prototype.getFilter=function(l,n){return this.builder("admin/stock?value="+l+"&field="+n).list()},n}(u("Uo/Y").a),p=function(){function l(l,n,u){this.service=l,this.modalService=n,this.toast=u,this.afterFilter=!1,this.stocks=[],this.filterTipoEstoque="",this.filterDescProduto="",this.filterCodProduto="",this.filterValidade="",this.filterLote="",this.modalReference=null,this.closeResult="",this.dateStart="",this.dateEnd="",this.link="",this.protocol="",this.company="",this.companyCnpj="",this.protocoloExport="",this.page=1}return l.prototype.ngOnInit=function(){this.user=JSON.parse(localStorage.getItem("user")),this.protocols=this.user.protocols,this.service.setAccessToken(),"admin"===this.user.role&&this.getClients()},l.prototype.getFilter=function(l,n){var u=this;this.company="user_company"===this.user.role?this.user.company.data.id:this.company,"codigo_produto"===n&&l.length>2?(this.afterFilter=!0,this.service.builder("admin/stock/"+this.company+"?value="+l+"&field="+n+"&protocolo="+this.protocol).list().then(function(l){u.stocks=l.data,u.meta=l.meta})):l.length>3&&(this.afterFilter=!0,this.service.builder("admin/stock/"+this.company+"?value="+l+"&field="+n+"&protocolo="+this.protocol).list().then(function(l){u.stocks=l.data,u.meta=l.meta}))},l.prototype.openModal=function(l,n){this.data=l,this.type=n;var u=this.modalService.open(c.a,{size:"lg"});u.componentInstance.data=this.data,u.componentInstance.type=this.type},l.prototype.open=function(l){var n=this;this.modalReference=this.modalService.open(l,{size:"sm",backdrop:"static"}),this.modalReference.result.then(function(l){n.closeResult="Closed with: "+l},function(l){n.closeResult="Dismissed "+n.getDismissReason(l)})},l.prototype.resetFilters=function(){this.filterTipoEstoque="",this.filterDescProduto="",this.afterFilter=!1,this.getStocks(this.company)},l.prototype.getDismissReason=function(l){return l===a.a.ESC?"by pressing ESC":l===a.a.BACKDROP_CLICK?"by clicking on a backdrop":"with: "+l},l.prototype.export=function(l,n){var u=this,t={start:"",end:"",protocol:l,cnpj:n};this.service.builder("admin/stock/export").insert(t).then(function(l){u.link=l.link,u.dateStart="",u.dateEnd="",window.open(l.link,"download"),u.toast.success("Download realizado","Sucesso"),u.modalReference.close()})},l.prototype.filter=function(l,n){var u=this;this.service.builder("admin/stock/filter?start="+l+"&end="+n).list().then(function(l){u.dateStart="",u.dateEnd="",u.modalReference.close()})},l.prototype.getStocks=function(l){var n=this;""!=l&&this.service.builder("admin/stock/all/"+l+"?page="+this.page).list().then(function(l){0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getPage=function(l){var n=this;this.service.loading.show(),console.log("loga"),"user_company"==this.user.role?this.service.builder("admin/stock/all/"+this.user.company.data.id+"?page="+l+"&protocolo="+this.protocol).list().then(function(l){n.service.loading.hide(),0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta}):this.service.builder("admin/stock/all/"+this.company+"?page="+l).list().then(function(l){n.service.loading.hide(),0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getStocksLote=function(l){var n=this;""!=l&&this.service.builder("admin/stock/all/"+this.user.company.data.id+"?protocolo="+l).list().then(function(l){0==l.data.length&&n.toast.info("Sem dados","Informa\xe7\xe3o"),n.stocks=l.data,n.meta=l.meta})},l.prototype.getClients=function(){var l=this;this.service.builder("admin/company").list().then(function(n){l.companies=n.data})},l}(),g=u("SZbH"),m=t.qb({encapsulation:0,styles:[[".primary-green.outs-title[_ngcontent-%COMP%]{color:#fff!important}"]],data:{}});function h(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.rb(1,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(2,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(3,null,["",""]))],function(l,n){l(n,1,0,t.ub(1,"",n.context.$implicit.id,"")),l(n,2,0,t.ub(1,"",n.context.$implicit.id,""))},function(l,n){l(n,3,0,n.context.$implicit.nome)})}function f(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,17,"div",[["class","col-md-3"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,16,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var e=!0;return"submit"===n&&(e=!1!==t.Cb(l,3).onSubmit(u)&&e),"reset"===n&&(e=!1!==t.Cb(l,3).onReset()&&e),e},null,null)),t.rb(2,16384,null,0,i.q,[],null,null),t.rb(3,4210688,null,0,i.k,[[8,null],[8,null]],null,null),t.Hb(2048,null,i.c,null,[i.k]),t.rb(5,16384,null,0,i.j,[[4,i.c]],null,null),(l()(),t.sb(6,0,null,null,11,"select",[["class","form-control"],["id","company"],["name","company"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var e=!0,o=l.component;return"change"===n&&(e=!1!==t.Cb(l,7).onChange(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,7).onTouched()&&e),"ngModelChange"===n&&(e=!1!==(o.company=u)&&e),"change"===n&&(e=!1!==o.getStocks(o.company)&&e),e},null,null)),t.rb(7,16384,null,0,i.n,[t.F,t.k],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.n]),t.rb(9,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(11,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(12,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.rb(13,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(14,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Selecione o cliente"])),(l()(),t.jb(16777216,null,null,1,null,h)),t.rb(17,278528,null,0,s.l,[t.Q,t.N,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,9,0,"company",u.company),l(n,13,0,""),l(n,14,0,""),l(n,17,0,u.companies)},function(l,n){l(n,1,0,t.Cb(n,5).ngClassUntouched,t.Cb(n,5).ngClassTouched,t.Cb(n,5).ngClassPristine,t.Cb(n,5).ngClassDirty,t.Cb(n,5).ngClassValid,t.Cb(n,5).ngClassInvalid,t.Cb(n,5).ngClassPending),l(n,6,0,t.Cb(n,11).ngClassUntouched,t.Cb(n,11).ngClassTouched,t.Cb(n,11).ngClassPristine,t.Cb(n,11).ngClassDirty,t.Cb(n,11).ngClassValid,t.Cb(n,11).ngClassInvalid,t.Cb(n,11).ngClassPending)})}function C(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.rb(1,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(2,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(3,null,["",""]))],function(l,n){l(n,1,0,t.ub(1,"",n.context.$implicit.tip_estoque,"")),l(n,2,0,t.ub(1,"",n.context.$implicit.tip_estoque,""))},function(l,n){l(n,3,0,n.context.$implicit.des_tip_estoque)})}function v(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,12,"div",[["class","col-md-3"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,11,"select",[["class","form-control"],["id","protocol"],["name","protocol"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var e=!0,o=l.component;return"change"===n&&(e=!1!==t.Cb(l,2).onChange(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,2).onTouched()&&e),"ngModelChange"===n&&(e=!1!==(o.protocol=u)&&e),"change"===n&&(e=!1!==o.getStocksLote(o.protocol)&&e),e},null,null)),t.rb(2,16384,null,0,i.n,[t.F,t.k],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.n]),t.rb(4,671744,null,0,i.l,[[8,null],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(6,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(7,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.rb(8,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(9,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Selecione o projeto"])),(l()(),t.jb(16777216,null,null,1,null,C)),t.rb(12,278528,null,0,s.l,[t.Q,t.N,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,4,0,"protocol",u.protocol),l(n,8,0,""),l(n,9,0,""),l(n,12,0,u.protocols.data)},function(l,n){l(n,1,0,t.Cb(n,6).ngClassUntouched,t.Cb(n,6).ngClassTouched,t.Cb(n,6).ngClassPristine,t.Cb(n,6).ngClassDirty,t.Cb(n,6).ngClassValid,t.Cb(n,6).ngClassInvalid,t.Cb(n,6).ngClassPending)})}function y(l){return t.Mb(0,[(l()(),t.Kb(-1,null,[" Filtros "]))],null,null)}function k(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,8,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"label",[],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Desc. Protocolo"])),(l()(),t.sb(3,0,null,null,5,"input",[["class","form-control"],["name","filterTipoEstoque"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Cb(l,4)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,4).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,4)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,4)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.filterTipoEstoque=u)&&e),"ngModelChange"===n&&(e=!1!==o.getFilter(o.filterTipoEstoque,"desc_tipo_estoque")&&e),e},null,null)),t.rb(4,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.d]),t.rb(6,671744,null,0,i.l,[[8,null],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(8,16384,null,0,i.i,[[4,i.h]],null,null)],function(l,n){l(n,6,0,"filterTipoEstoque",n.component.filterTipoEstoque)},function(l,n){l(n,3,0,t.Cb(n,8).ngClassUntouched,t.Cb(n,8).ngClassTouched,t.Cb(n,8).ngClassPristine,t.Cb(n,8).ngClassDirty,t.Cb(n,8).ngClassValid,t.Cb(n,8).ngClassInvalid,t.Cb(n,8).ngClassPending)})}function F(l){return t.Mb(0,[(l()(),t.jb(16777216,null,null,1,null,k)),t.rb(1,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(2,0,null,null,8,"div",[["class","form-group"]],null,null,null,null,null)),(l()(),t.sb(3,0,null,null,1,"label",[],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Desc. Produto"])),(l()(),t.sb(5,0,null,null,5,"input",[["class","form-control"],["name","filterDescProduto"],["type","text"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"input"],[null,"blur"],[null,"compositionstart"],[null,"compositionend"]],function(l,n,u){var e=!0,o=l.component;return"input"===n&&(e=!1!==t.Cb(l,6)._handleInput(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,6).onTouched()&&e),"compositionstart"===n&&(e=!1!==t.Cb(l,6)._compositionStart()&&e),"compositionend"===n&&(e=!1!==t.Cb(l,6)._compositionEnd(u.target.value)&&e),"ngModelChange"===n&&(e=!1!==(o.filterDescProduto=u)&&e),"ngModelChange"===n&&(e=!1!==o.getFilter(o.filterDescProduto,"desc_produto")&&e),e},null,null)),t.rb(6,16384,null,0,i.d,[t.F,t.k,[2,i.a]],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.d]),t.rb(8,671744,null,0,i.l,[[8,null],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(10,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(11,0,null,null,1,"button",[["class","btn btn-outline-info"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.resetFilters()&&t),t},null,null)),(l()(),t.Kb(-1,null,["Limpar Filtros"]))],function(l,n){var u=n.component;l(n,1,0,"admin"==u.user.role||"drs_admin"==u.user.role),l(n,8,0,"filterDescProduto",u.filterDescProduto)},function(l,n){l(n,5,0,t.Cb(n,10).ngClassUntouched,t.Cb(n,10).ngClassTouched,t.Cb(n,10).ngClassPristine,t.Cb(n,10).ngClassDirty,t.Cb(n,10).ngClassValid,t.Cb(n,10).ngClassInvalid,t.Cb(n,10).ngClassPending)})}function M(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"tr",[],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,2,"td",[["colspan","10"]],null,null,null,null,null)),(l()(),t.sb(2,0,null,null,1,"p",[["class","font-weight-bold"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Sem dados para exibir"]))],null,null)}function j(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,14,"tr",[],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Kb(2,null,["",""])),(l()(),t.sb(3,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Kb(4,null,["",""])),(l()(),t.sb(5,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Kb(6,null,["",""])),(l()(),t.sb(7,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Kb(8,null,["",""])),(l()(),t.sb(9,0,null,null,1,"td",[],null,null,null,null,null)),(l()(),t.Kb(10,null,["",""])),(l()(),t.sb(11,0,null,null,3,"td",[],null,null,null,null,null)),(l()(),t.sb(12,16777216,null,null,2,"button",[["class","btn btn-link"],["ngbTooltip","Detalhes"],["placement","top"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.component.openModal(l.context.$implicit,"stocks")&&t),t},null,null)),t.rb(13,212992,null,0,a.Z,[t.k,t.F,t.r,t.j,t.Q,a.ab,t.A,s.d],{placement:[0,"placement"],ngbTooltip:[1,"ngbTooltip"]},null),(l()(),t.sb(14,0,null,null,0,"i",[["class","fa fa-info-circle"]],null,null,null,null,null))],function(l,n){l(n,13,0,"top","Detalhes")},function(l,n){l(n,2,0,n.context.$implicit.desc_tipo_estoque),l(n,4,0,n.context.$implicit.desc_produto),l(n,6,0,n.context.$implicit.lote),l(n,8,0,n.context.$implicit.data_validade),l(n,10,0,n.context.$implicit.qtd_produto)})}function A(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,1,"ngb-pagination",[["role","navigation"],["size","sm"]],null,[[null,"pageChange"]],function(l,n,u){var t=!0,e=l.component;return"pageChange"===n&&(t=!1!==(e.meta.pagination.current_page=u)&&t),"pageChange"===n&&(t=!1!==e.getPage(u)&&t),t},r.g,r.d)),t.rb(1,573440,null,0,a.C,[a.D],{boundaryLinks:[0,"boundaryLinks"],rotate:[1,"rotate"],collectionSize:[2,"collectionSize"],maxSize:[3,"maxSize"],page:[4,"page"],pageSize:[5,"pageSize"],size:[6,"size"]},{pageChange:"pageChange"})],function(l,n){var u=n.component;l(n,1,0,!0,!0,u.meta.pagination.total,5,u.meta.pagination.current_page,u.meta.pagination.per_page,"sm")},null)}function x(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.rb(1,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(2,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(3,null,["",""]))],function(l,n){l(n,1,0,t.ub(1,"",n.context.$implicit.cnpj,"")),l(n,2,0,t.ub(1,"",n.context.$implicit.cnpj,""))},function(l,n){l(n,3,0,n.context.$implicit.nome)})}function S(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,14,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"label",[["class","label"],["for","protocolo"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Cliente:"])),(l()(),t.sb(3,0,null,null,11,"select",[["class","form-control"],["id","protocolo"],["name","protocolo"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var e=!0,o=l.component;return"change"===n&&(e=!1!==t.Cb(l,4).onChange(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,4).onTouched()&&e),"ngModelChange"===n&&(e=!1!==(o.companyCnpj=u)&&e),e},null,null)),t.rb(4,16384,null,0,i.n,[t.F,t.k],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.n]),t.rb(6,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(8,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.rb(10,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(11,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Selecione o cliente"])),(l()(),t.jb(16777216,null,null,1,null,x)),t.rb(14,278528,null,0,s.l,[t.Q,t.N,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,6,0,"protocolo",u.companyCnpj),l(n,10,0,""),l(n,11,0,""),l(n,14,0,u.companies)},function(l,n){l(n,3,0,t.Cb(n,8).ngClassUntouched,t.Cb(n,8).ngClassTouched,t.Cb(n,8).ngClassPristine,t.Cb(n,8).ngClassDirty,t.Cb(n,8).ngClassValid,t.Cb(n,8).ngClassInvalid,t.Cb(n,8).ngClassPending)})}function P(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,3,"option",[],null,null,null,null,null)),t.rb(1,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(2,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(3,null,["",""]))],function(l,n){l(n,1,0,t.ub(1,"",n.context.$implicit.tip_estoque,"")),l(n,2,0,t.ub(1,"",n.context.$implicit.tip_estoque,""))},function(l,n){l(n,3,0,n.context.$implicit.des_tip_estoque)})}function I(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,14,"div",[["class","row form-group"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"label",[["class","label"],["for","company_select"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Projeto:"])),(l()(),t.sb(3,0,null,null,11,"select",[["class","form-control"],["id","company_select"],["name","company"]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"ngModelChange"],[null,"change"],[null,"blur"]],function(l,n,u){var e=!0,o=l.component;return"change"===n&&(e=!1!==t.Cb(l,4).onChange(u.target.value)&&e),"blur"===n&&(e=!1!==t.Cb(l,4).onTouched()&&e),"ngModelChange"===n&&(e=!1!==(o.protocoloExport=u)&&e),e},null,null)),t.rb(4,16384,null,0,i.n,[t.F,t.k],null,null),t.Hb(1024,null,i.g,function(l){return[l]},[i.n]),t.rb(6,671744,null,0,i.l,[[2,i.c],[8,null],[8,null],[6,i.g]],{name:[0,"name"],model:[1,"model"]},{update:"ngModelChange"}),t.Hb(2048,null,i.h,null,[i.l]),t.rb(8,16384,null,0,i.i,[[4,i.h]],null,null),(l()(),t.sb(9,0,null,null,3,"option",[["value",""]],null,null,null,null,null)),t.rb(10,147456,null,0,i.m,[t.k,t.F,[2,i.n]],{value:[0,"value"]},null),t.rb(11,147456,null,0,i.s,[t.k,t.F,[8,null]],{value:[0,"value"]},null),(l()(),t.Kb(-1,null,["Selecione o projeto"])),(l()(),t.jb(16777216,null,null,1,null,P)),t.rb(14,278528,null,0,s.l,[t.Q,t.N,t.t],{ngForOf:[0,"ngForOf"]},null)],function(l,n){var u=n.component;l(n,6,0,"company",u.protocoloExport),l(n,10,0,""),l(n,11,0,""),l(n,14,0,u.protocols.data)},function(l,n){l(n,3,0,t.Cb(n,8).ngClassUntouched,t.Cb(n,8).ngClassTouched,t.Cb(n,8).ngClassPristine,t.Cb(n,8).ngClassDirty,t.Cb(n,8).ngClassValid,t.Cb(n,8).ngClassInvalid,t.Cb(n,8).ngClassPending)})}function _(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,5,"div",[["class","modal-header primary-green"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"h3",[["class","outs-title text-white"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Exportar posi\xe7\xe3o de estoque atual"])),(l()(),t.sb(3,0,null,null,2,"button",[["aria-label","Close"],["class","close"],["type","button"]],null,[[null,"click"]],function(l,n,u){var t=!0;return"click"===n&&(t=!1!==l.context.dismiss("Cross click")&&t),t},null,null)),(l()(),t.sb(4,0,null,null,1,"span",[["aria-hidden","true"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["\xd7"])),(l()(),t.sb(6,0,null,null,11,"div",[["class","modal-body"]],null,null,null,null,null)),(l()(),t.sb(7,0,null,null,10,"form",[["novalidate",""]],[[2,"ng-untouched",null],[2,"ng-touched",null],[2,"ng-pristine",null],[2,"ng-dirty",null],[2,"ng-valid",null],[2,"ng-invalid",null],[2,"ng-pending",null]],[[null,"submit"],[null,"reset"]],function(l,n,u){var e=!0;return"submit"===n&&(e=!1!==t.Cb(l,9).onSubmit(u)&&e),"reset"===n&&(e=!1!==t.Cb(l,9).onReset()&&e),e},null,null)),t.rb(8,16384,null,0,i.q,[],null,null),t.rb(9,4210688,null,0,i.k,[[8,null],[8,null]],null,null),t.Hb(2048,null,i.c,null,[i.k]),t.rb(11,16384,null,0,i.j,[[4,i.c]],null,null),(l()(),t.jb(16777216,null,null,1,null,S)),t.rb(13,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.jb(16777216,null,null,1,null,I)),t.rb(15,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(16,0,null,null,1,"button",[["class","btn btn-block btn-success"]],[[8,"disabled",0]],[[null,"click"]],function(l,n,u){var t=!0,e=l.component;return"click"===n&&(t=!1!==e.export(e.protocoloExport,e.companyCnpj)&&t),t},null,null)),(l()(),t.Kb(-1,null,["Gerar arquivo"]))],function(l,n){var u=n.component;l(n,13,0,"admin"==u.user.role||"drs_admin"==u.user.role),l(n,15,0,"user_company"==u.user.role)},function(l,n){var u=n.component;l(n,7,0,t.Cb(n,11).ngClassUntouched,t.Cb(n,11).ngClassTouched,t.Cb(n,11).ngClassPristine,t.Cb(n,11).ngClassDirty,t.Cb(n,11).ngClassValid,t.Cb(n,11).ngClassInvalid,t.Cb(n,11).ngClassPending),l(n,16,0,"user_company"==u.user.role&&""==u.protocoloExport||"admin"==u.user.role&&""==u.companyCnpj)})}function K(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,2,"div",[["class","header bg-gradient-success pb-8 pt-5"]],null,null,null,null,null)),(l()(),t.sb(1,0,null,null,1,"div",[["class","container-fluid"]],null,null,null,null,null)),(l()(),t.sb(2,0,null,null,0,"div",[["class","header-body"]],null,null,null,null,null)),(l()(),t.sb(3,0,null,null,45,"div",[["class","container-fluid mt--7"]],null,null,null,null,null)),(l()(),t.sb(4,0,null,null,44,"div",[["class","row stocks"]],null,null,null,null,null)),(l()(),t.sb(5,0,null,null,43,"div",[["class","col"]],null,null,null,null,null)),(l()(),t.sb(6,0,null,null,42,"div",[["class","card shadow"]],null,null,null,null,null)),(l()(),t.sb(7,0,null,null,16,"div",[["class","card-header border-0 d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.sb(8,0,null,null,1,"h3",[["class","mb-0"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Estoque"])),(l()(),t.jb(16777216,null,null,1,null,f)),t.rb(11,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.jb(16777216,null,null,1,null,v)),t.rb(13,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(14,0,null,null,9,"div",[["class","mb-0 col-lg-3 d-flex justify-content-end"]],null,null,null,null,null)),(l()(),t.sb(15,0,null,null,2,"button",[["class","mb-0 btn-sm btn-link"]],null,[[null,"click"]],function(l,n,u){var e=!0;return"click"===n&&(e=!1!==l.component.open(t.Cb(l,50))&&e),e},null,null)),(l()(),t.sb(16,0,null,null,0,"i",[["class","fa fa-file-excel"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,[" Exportar"])),(l()(),t.sb(18,16777216,null,null,3,"button",[["class","mb-0 btn-sm btn-filter btn-link"],["placement","bottom"],["popoverClass","custom-popover"],["type","button"]],null,null,null,null,null)),t.rb(19,737280,null,0,a.H,[t.k,t.F,t.r,t.j,t.Q,a.I,t.A,s.d],{autoClose:[0,"autoClose"],ngbPopover:[1,"ngbPopover"],popoverTitle:[2,"popoverTitle"],placement:[3,"placement"],popoverClass:[4,"popoverClass"]},null),(l()(),t.sb(20,0,null,null,0,"i",[["class","fa fa-filter"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,[" Filtros "])),(l()(),t.jb(0,[["popTitle",2]],null,0,null,y)),(l()(),t.jb(0,[["popContent",2]],null,0,null,F)),(l()(),t.sb(24,0,null,null,20,"div",[["class","table-responsive"]],null,null,null,null,null)),(l()(),t.sb(25,0,null,null,19,"table",[["class","table align-items-center table-flush"]],null,null,null,null,null)),(l()(),t.sb(26,0,null,null,13,"thead",[["class","thead-light"]],null,null,null,null,null)),(l()(),t.sb(27,0,null,null,12,"tr",[],null,null,null,null,null)),(l()(),t.sb(28,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Des.Protocolo"])),(l()(),t.sb(30,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Des.Produto"])),(l()(),t.sb(32,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Lote"])),(l()(),t.sb(34,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Validade"])),(l()(),t.sb(36,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["Qtd.Disponivel"])),(l()(),t.sb(38,0,null,null,1,"th",[["scope","col"]],null,null,null,null,null)),(l()(),t.Kb(-1,null,["A\xe7\xf5es"])),(l()(),t.sb(40,0,null,null,4,"tbody",[],null,null,null,null,null)),(l()(),t.jb(16777216,null,null,1,null,M)),t.rb(42,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.jb(16777216,null,null,1,null,j)),t.rb(44,278528,null,0,s.l,[t.Q,t.N,t.t],{ngForOf:[0,"ngForOf"]},null),(l()(),t.sb(45,0,null,null,3,"div",[["class","container-pagination d-flex justify-content-between"]],null,null,null,null,null)),(l()(),t.sb(46,0,null,null,2,"div",[["class","col-md-6"]],null,null,null,null,null)),(l()(),t.jb(16777216,null,null,1,null,A)),t.rb(48,16384,null,0,s.m,[t.Q,t.N],{ngIf:[0,"ngIf"]},null),(l()(),t.sb(49,0,null,null,1,"section",[],null,null,null,null,null)),(l()(),t.jb(0,[["content",2]],null,0,null,_))],function(l,n){var u=n.component;l(n,11,0,"admin"==u.user.role),l(n,13,0,"admin"!=u.user.role),l(n,19,0,"outside",t.Cb(n,23),t.Cb(n,22),"bottom","custom-popover"),l(n,42,0,0==u.stocks.length),l(n,44,0,u.stocks),l(n,48,0,u.stocks.length>0&&0==u.afterFilter)},null)}function D(l){return t.Mb(0,[(l()(),t.sb(0,0,null,null,1,"app-tables",[],null,null,null,K,m)),t.rb(1,114688,null,0,p,[d,a.y,g.j],null,null)],function(l,n){l(n,1,0)},null)}var T=t.ob("app-tables",p,D,{},{},[]),E=u("t/Na"),w=u("ZYCi"),q=u("miAi"),$=u("gFH1"),H=function(){return function(){}}(),N=u("j1ZV"),Q=u("atAv");u.d(n,"StocksModuleNgFactory",function(){return z});var z=t.pb(e,[],function(l){return t.zb([t.Ab(512,t.j,t.db,[[8,[o.a,T,r.a,r.b,r.m,r.i,r.j,r.k,r.l]],[3,t.j],t.y]),t.Ab(4608,s.o,s.n,[t.v,[2,s.B]]),t.Ab(4608,i.r,i.r,[]),t.Ab(4608,a.y,a.y,[t.j,t.r,a.eb,a.z]),t.Ab(4608,d,d,[E.c,w.k,g.j,q.c,a.y,$.a]),t.Ab(1073742336,s.b,s.b,[]),t.Ab(1073742336,w.n,w.n,[[2,w.t],[2,w.k]]),t.Ab(1073742336,H,H,[]),t.Ab(1073742336,i.o,i.o,[]),t.Ab(1073742336,i.e,i.e,[]),t.Ab(1073742336,a.d,a.d,[]),t.Ab(1073742336,a.h,a.h,[]),t.Ab(1073742336,a.i,a.i,[]),t.Ab(1073742336,a.m,a.m,[]),t.Ab(1073742336,a.o,a.o,[]),t.Ab(1073742336,a.t,a.t,[]),t.Ab(1073742336,a.w,a.w,[]),t.Ab(1073742336,a.A,a.A,[]),t.Ab(1073742336,a.E,a.E,[]),t.Ab(1073742336,a.J,a.J,[]),t.Ab(1073742336,a.M,a.M,[]),t.Ab(1073742336,a.P,a.P,[]),t.Ab(1073742336,a.U,a.U,[]),t.Ab(1073742336,a.Y,a.Y,[]),t.Ab(1073742336,a.bb,a.bb,[]),t.Ab(1073742336,a.cb,a.cb,[]),t.Ab(1073742336,a.B,a.B,[]),t.Ab(1073742336,N.a,N.a,[]),t.Ab(1073742336,Q.a,Q.a,[]),t.Ab(1073742336,e,e,[]),t.Ab(1024,w.i,function(){return[[{path:"",component:p}]]},[])])})}}]);