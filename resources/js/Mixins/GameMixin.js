export default {
    methods: {
        playAgain(){
            var vm = this;
            vm.config.inputData.inputs.forEach(input => {
              document.getElementById("inputData_" + input.name).value = '';
            });
    
            var outputDataFields = document.getElementsByClassName("output-data");
            for (var i = 0; i < outputDataFields.length; i++) {
              document.getElementsByClassName("output-data")[i].innerHTML = '';
            }
    
            vm.config.graphData = {
                revenue: [],
                profit: [],
                cost: []
            };
            
            
            vm.clearErrors();
          },
          showPage(page){
            var vm = this;
            vm.config.pageData.pages.forEach(pageItem => {
              if(pageItem.name == page){
                if(!pageItem.content.length){
  
                  axios({
                    method: 'get',
                    url: '/api/game/'+vm.gameName+'/page',
                    params: {
                      page: page
                    },
                  })
                  .then(function (response) {
                    if(response.data.success){
                      pageItem.content = response.data.data.pageContent;
                      pageItem.title = response.data.data.pageTitle;
                      
                      vm.dynamicModalPageComponent.title = pageItem.title;
                      vm.dynamicModalPageComponent.content = atob(pageItem.content);
                      vm.dynamicModalPageComponent.open = true;
                    }
                  });
                } else {
                  vm.dynamicModalPageComponent.title = pageItem.title;
                  vm.dynamicModalPageComponent.content = atob(pageItem.content);
                  vm.dynamicModalPageComponent.open = true;
                }
              }
            });
          },
          clearErrors(){
            var vm = this;
            vm.config.inputData.inputs.forEach(input => {
              input.error = null;
            });
          },
          showAlert(alert){
            window.alert(alert);
          },
          compute() {
            var vm = this;
            vm.clearErrors();
            var formData = new FormData();
            vm.config.inputData.inputs.forEach(input => {
              formData.append(input.name, document.getElementById("inputData_" + input.name).value);
            });
            axios({
              method: 'post',
              url: '/api/game/'+vm.gameName+'/compute',
              data: formData,
    
            })
            .then(function (response) {
              if(response.data.success){
                
                  Number.prototype.toLocaleFixed = function(n) {
                    return this.toLocaleString(undefined, {
                      minimumFractionDigits: n,
                      maximumFractionDigits: n
                    });
                  };
                   for (var [key1, value1] of Object.entries(response.data.data.outputData)) {
                       for(let key = 0; key < value1.length; key++){
                         var value = value1[key];
                      switch(document.getElementById("outputData_" + key1 + "_" + key).getAttribute('t')){
                        case "integer":
                          document.getElementById("outputData_" + key1 + "_" + key).innerHTML = (value).toLocaleFixed(0);
                          break;
                        case "decimal-2":
                          document.getElementById("outputData_" + key1 + "_" + key).innerHTML = Number(value).toLocaleFixed(2);
                          break;
                        case "currency":
                          if(Number(value) > 0){
                            document.getElementById("outputData_" + key1 + "_" + key).innerHTML = "$" + Number(value).toLocaleFixed(0);
                          } else {
                            document.getElementById("outputData_" + key1 + "_" + key).innerHTML = "-$" + Number(Math.abs(value)).toLocaleFixed(0);
                          }
                          break;
                        case "currency-2":
                          if(Number(value) > 0){
                            document.getElementById("outputData_" + key1 + "_" + key).innerHTML = "$" + Number(value).toLocaleFixed(2);
                          } else {
                            document.getElementById("outputData_" + key1 + "_" + key).innerHTML = "-$" + Number(Math.abs(value)).toLocaleFixed(2);
                          }
                          break;
                        case "string":
                            document.getElementById("outputData_" + key1 + "_" + key).innerHTML = (value);
                            break;
                        case "percentage":
                          document.getElementById("outputData_" + key1 + "_" + key).innerHTML = Number(value).toLocaleFixed(0) + "%";
                          break;
                        case "percentage-2":
                          document.getElementById("outputData_" + key1 + "_" + key).innerHTML = Number(value).toLocaleFixed(2) + "%";
                          break;
                      }
                    }
                  }
                  vm.config.graphData = response.data.data.graphData;
              } else {
                
                for (var [key, error] of Object.entries(response.data.errors)) {
                    vm.config.inputData.inputs.forEach(input => {
                        if(key == input.name){
                          input.error = error;
                        }
                      });
                  }
              }
            })
            .catch(function (error) {
              //TODO:
              //alert("Please refresh the page and try again");
            });
          },
          loadData(){
            var vm = this;
            axios({
              method: 'get',
              url: '/api/game/'+vm.gameName+'/config',
            })
            .then(function (response) {
              if(response.data.success){
                vm.config = response.data.data.config;
              }
            });
          },
    }
  };