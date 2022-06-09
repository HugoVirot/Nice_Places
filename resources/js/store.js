//import Vuex from "vuex";

// // on importe createStore et on initialise le store
import { createStore } from 'vuex'

const getDefaultState = () => {
    return {
        userData: {
            pseudo: "",
            email: "",
            token: "",
        },
        message: ""
    };
  };
  
  const state = getDefaultState();

//export const store = new Vuex.Store({
export const store = createStore({
    state,

    mutations: {
        storeUserData(state, payload) {
            state.userData.pseudo = payload.pseudo
            state.userData.email = payload.email
            state.userData.token = payload.token
        },

        storeMessage(state, payload){
            state.message = payload
        },
        resetState(state) {
            Object.assign(state, getDefaultState());
          },
    },
    
    getters: {
        getUserData(state) {
            return state.userData
        },

        getMessage(state) {
            return state.message
        }

    }
})

