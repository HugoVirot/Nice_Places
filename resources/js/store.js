//import Vuex from "vuex";

// // on importe createStore et on initialise le store
import { createStore } from 'vuex'

export const store = createStore({
    state() {
        return {
            userData: {
                pseudo: "",
                email: "",
                id: "",
                departement: "",
                token: "",
            },
            message: ""
        }
    },

    mutations: {
        storeUserData(state, payload) {
            state.userData.pseudo = payload.pseudo
            state.userData.email = payload.email
            state.userData.id = payload.id
            if (payload.departement){
                state.userData.departement = payload.departement
            }
            state.userData.token = payload.token
        },

        storeMessage(state, payload) {
            state.message = payload
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

// store avec state réinitialisable (cause des problèmes : state vide entre les composants, notamment dans MonCompte.vue)

// const getDefaultState = () => {
//     return {
//         userData: {
//             pseudo: "",
//             email: "",
//             token: "",
//         },
//         message: ""
//     };
//   };

//   const state = getDefaultState();

// //export const store = new Vuex.Store({
// export const store = createStore({
//     state,

//     mutations: {
//         storeUserData(state, payload) {
//             state.userData.pseudo = payload.pseudo
//             state.userData.email = payload.email
//             state.userData.token = payload.token
//         },

//         storeMessage(state, payload){
//             state.message = payload
//         },

//         resetState(state) {
//             Object.assign(state, getDefaultState());
//           },
//     },

//     getters: {
//         getUserData(state) {
//             return state.userData
//         },

//         getMessage(state) {
//             return state.message
//         }

//     }
// })


