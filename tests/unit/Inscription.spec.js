import { createTestingPinia } from '@pinia/testing'  // import de pinia (version pour tests unitaires)
import Inscription from "../../resources/js/components/user/Inscription.vue" // import du composant Inscription
import { shallowMount, RouterLinkStub } from '@vue/test-utils'; // import de shallowMount (pour instancier le composant
// sans ses composants enfants) + RouterLinkStub (pour que le bouton router-link soit reconnu durant le test)

const sendData = jest.spyOn(Inscription.methods, 'sendData') // on initialise la fonction logIn pour tester son appel

const wrapper = shallowMount(Inscription, {  // on instancie le composant avec shallowMount
    global: {
        plugins: [createTestingPinia()],  // on inclut le store pinia via le plug-in 
        stubs: {
            'router-link': RouterLinkStub, // on inclut routerlinkStub pour éviter une erreur sur router-link
        }
    }
})

describe("Vérifications sur le composant Inscription.vue", () => { // 1er test 
    it('titre de la page affiché', () => {
        const title = wrapper.get('h1')
        expect(title.text()).toBe('Inscription')
    })

    it("remplissage du formulaire", () => {
        const pseudo = wrapper.find("#pseudo")
        pseudo.setValue('test')
        expect(pseudo.element.value).toBe("test")

        const email = wrapper.find("#email")
        email.setValue('utilisateur@test.fr')
        expect(email.element.value).toBe("utilisateur@test.fr")

        const password = wrapper.find("#password")
        password.setValue('Azerty88@')
        expect(password.element.value).toBe("Azerty88@")
        
        const passwordConfirmation = wrapper.find("#password_confirmation")
        passwordConfirmation.setValue('Azerty88@')
        expect(passwordConfirmation.element.value).toBe("Azerty88@")
    })

    it('validation ok (fonction sendData déclenchée)', async () => {
        await wrapper.find('form').trigger('submit.prevent');
        expect(sendData).toBeCalled();
    })

})
