import Connexion from "../../resources/js/components/user/Connexion.vue" // import du composant Inscription
import { shallowMount, RouterLinkStub } from '@vue/test-utils' // import de shallowMount (pour instancier le composant
// sans ses composants enfants) + RouterLinkStub (pour que le bouton router-link soit reconnu durant le test)

const logIn = jest.spyOn(Connexion.methods, 'logIn') // on initialise la fonction logIn pour tester son appel

const wrapper = shallowMount(Connexion, {  // on instancie le composant avec shallowMount
    global: {
        stubs: {
            'router-link': RouterLinkStub, // on inclut routerlinkStub pour éviter une erreur sur router-link
        }
    }
})
// tests successifs : 1) titre de la page affiché, 2) remplissage du formulaire ok
// 3) fonction logIn déclenchée lorsque l'on clique sur "Valider"

describe("Vérifications sur le composant Connexion.vue", () => {
    it('affichage du titre de la page', () => {
        const title = wrapper.get('h1')
        expect(title.text()).toBe('Connexion')
    })

    it('remplissage du formulaire (email + password)', () => {
        const email = wrapper.find("#email")
        email.setValue('utilisateur@test.fr')
        expect(email.element.value).toBe("utilisateur@test.fr")

        const password = wrapper.find("#password")
        password.setValue('Azerty88@')
        expect(password.element.value).toBe("Azerty88@")
    })

    it('validation ok (fonction logIn déclenchée)', async () => {
        await wrapper.find('form').trigger('submit.prevent');
        expect(logIn).toBeCalled();
    })
})
