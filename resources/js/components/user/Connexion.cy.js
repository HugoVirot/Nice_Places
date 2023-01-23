import Connexion from './Connexion.vue' // import du composant

// describe : contient tous les tests pour ce composant
// 1er paramètre : description du test / 2nd paramètre : la fonction anonyme qui contient les tests
// it : un test individuel (on peut en mettre plusieurs)

describe('<Connexion />', () => {
  it('renders', () => {
    // see: https://test-utils.vuejs.org/guide/
    cy.mount(Connexion)
  })
})