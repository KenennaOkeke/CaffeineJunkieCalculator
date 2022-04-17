<template>
    <game-container>
      <button-group>
        <game-button @click="playAgain">Play Again</game-button>
        <game-button @click="compute">Compute</game-button>
        <game-button @click="showPage('story')">Background</game-button>
        <game-button @click="showPage('disclaimer')">DISCLAIMER</game-button>
      </button-group>
      <game-main>
        <div class="col-span-7">
          <inputs v-bind:inputData="config.inputData"></inputs>
        </div>
        <div class="col-span-5">
          <outputs v-bind:outputData="config.outputData"></outputs>
        </div>
      </game-main>
      <modal-page v-bind:pageData="dynamicModalPageComponent"></modal-page>
    </game-container>
</template>

<style>
/* Colors Inso From: https://colorhunt.co/palette/29000187431dc87941dbcbbd */

body{
  background-color: #290001 !important;
}

.text-gray-900 {
  color: #290001 !important;
}

.bg-white{
  background-color: #C87941 !important;
}
.border-gray-200{
  border-color:#290001 !important;
}

input {
  background-color: #DBCBBD !important;
  color: #290001 !important;
}

.output-data{
  color: #DBCBBD !important;
}

button{
  background-color: #87431D !important;
  color: #DBCBBD !important;
  border-color:#C87941 !important;
}

thead, thead .text-gray-500{
  background-color: #290001 !important;
  color: #DBCBBD !important;
}
</style>

<script>
  import GameMixin from "../Mixins/GameMixin";

  import GameContainer from '../Components/Game/Container';
  import ButtonGroup from '../Components/Game/ButtonGroup';
  import GameButton from '../Components/Game/Button';
  import GameMain from '../Components/Game/Main';
  import Inputs from '../Components/Game/Inputs';
  import Outputs from '../Components/Game/Outputs';
  import ModalPage from '../Components/Game/ModalPage';

  export default {
    mixins: [GameMixin],
    components: {
      GameContainer,
      ButtonGroup,
      GameButton,
      GameMain,
      Inputs,
      Outputs,
      ModalPage
    },
    data() {
        return {
          config : {
            inputData: [],
            graphData: [],
            outputData: [],
            pageData: [],
          },
          dynamicModalPageComponent: {
              "open": false,
            }
        }
    },
    created() {
      //We want to get the data for this game...
      var vm = this;
      vm.gameName = "caffeine_simulator";
      vm.loadData();
    },
    methods : {
      showMarketResearchPage() { //TODO: eventually add an option in the showPage function to take in a descion and a regex rule, and if it fails, show the passed error message
        var vm = this;
        if(document.getElementById("inputData_consulting").value == 'yes') {
          vm.showPage('analytics');
        } else {
          vm.showPage('analytics_purchase_required');
        }
      }
    }
  }
</script>