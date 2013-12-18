(function() {
   
    var parser = {
        
        $table : jQuery('.table'),
        refreshTask : 'refreshTask',
        ajaxUrl : '/ajax/updateCronStatus',

        initialize : function () { 
            this.extend();
            this.modules();            
            this.initializeOtherPlugins();
            this.setUpListeners();
        },
        extend : function () {
            $.extend(this, APP);
        },
 
        modules: function () {
          
        },
        initializeOtherPlugins : function()
        {
            
        }, 
        setUpListeners: function () 
        {            
            this.$table.on('click', 'a.'+this.refreshTask, this, $.proxy(this.refreshTaskFunc, this) );
        },
        refreshTaskFunc : function (e)
        {
            var $currentElemnt = $(e.currentTarget);
            var currentId = $currentElemnt.attr('name');
          
            var params = {};
            params.url = this.ajaxUrl;
            params.data = {id:currentId};

            var response_obj = this.ajax(params);
           
            if(response_obj.error instanceof Object || response_obj.error !== '') {
                alert('error');
                return false;
            }
             //refrash page
            location.reload();
        }
      

    }
  
    parser.initialize();
 
}());


