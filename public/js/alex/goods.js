(function() {
   
    var goods = {
        
        $table : jQuery('.table'),
 

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
            this.initializeTableSorter();        
        }, 
        setUpListeners: function () 
        {            
           
        },
        initializeTableSorter : function () {
            this.$table.tablesorter( {sortList: [[0,0], [1,0]]} ); 
        }

    }
  
    goods.initialize();
 
}());


