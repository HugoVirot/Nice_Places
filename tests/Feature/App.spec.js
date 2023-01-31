// vérifier que les lieux sont bien importés sur l'accueil
import { setActivePinia, createPinia } from 'pinia'
import { createTestingPinia } from '@pinia/testing'
import { useLieuxStore } from '../../resources/js/stores/lieuxStore'
import App from "../../resources/js/components/App.vue"
import { shallowMount } from "@vue/test-utils"
import { mount } from '@vue/test-utils'
import { RouterLinkStub } from '@vue/test-utils';


window.alert = jest.fn();

test("login api resolves true", () => {
  window.alert.mockClear();
  /* ... */
})

const wrapper = mount(App, {
    global: {
      plugins: [createTestingPinia()],
    },
    mocks: {
      $route: {
        path: '/'
      }
    },
    stubs: {
        routerlink: RouterLinkStub
    }
  })

const lieuxStore = useLieuxStore()

lieuxStore.storeLieux()
// state can be directly manipulated
// store.name = 'my new name'
// // can also be done through patch
// store.$patch({ name: 'new name' })
// expect(store.name).toBe('new name')

// actions are stubbed by default, meaning they don't execute their code by default.
// See below to customize this behavior.

expect(lieuxStore.storeLieux).toHaveBeenCalledTimes(1)
//expect(store.someAction).toHaveBeenLastCalledWith()



// describe('Check if places are correctly retrieved on App component', () => {

//     beforeEach(() => {
//       // creates a fresh pinia and make it active so it's automatically picked
//       // up by any useStore() call without having to pass it to it:
//       // `useStore(pinia)`
//       setActivePinia(createPinia())
//     })
  
//     // it('increments', () => {
//     //   const counter = useCounter()
//     //   expect(counter.n).toBe(0)
//     //   counter.increment()
//     //   expect(counter.n).toBe(1)
//     // })
  
//     it('increments by amount', () => {
//       const lieuxStore = useLieuxStore()
//       counter.increment(10)
//       expect(counter.n).toBe(10)
//     })
//   })
  
// erreur car bute sur this.lieux (store inaccessible)
// describe("App.vue", () => {
//     it('shows the right title', () => {
//         const wrapper = shallowMount(App)  //wrapper = objet qui simule le composant
//         const title = wrapper.get('h1')
//         expect(title.text()).toBe('Redécouvrez votre région !')        
//     })
// })
  
// que tester sur App ?
// - 3 top places and 3 last places récupérées
// voir doc de pinia

//shallowmount : Like mount, it creates a Wrapper that contains the mounted and rendered Vue component, but with stubbed child components.

// What the documentation means by "stubbed child components" is that every components within the tested one will not be rendered. 
//Instead, you will have a placeholder component.
// This prevent your tests to be parasited by other component's behaviors.
// In my opinion, you should always shallow mount your components when doing unit tests, and simply mount them when doing 
//tests in your entire application.
