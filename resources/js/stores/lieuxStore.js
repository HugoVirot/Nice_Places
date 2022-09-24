import { defineStore } from 'pinia'

export const useLieuxStore = defineStore({
    // id requis pour connecter le store aux devtools
    id: 'LieuxStore',

    state: () => {
        return {
            lieux: "",
            departements: "",
            regions: "",
            threeTopPlaces: "",
            threeLastPlaces: "",
            categories: ""
        }
    },

    actions: {
        storeLieux(lieux) {
            console.log("storeLieux");
            this.lieux = lieux
        },

        storeDepartements(departements) {
            this.departements = departements
        },

        storeCategories(categories) {
            this.categories = categories
        },
        
        storeRegions(regions) {
            this.regions = regions
        },

        storeThreeTopPlaces(threeTopPlaces) {
            this.threeTopPlaces = threeTopPlaces
        },

        storeThreeLastPlaces(threeLastPlaces) {
            this.threeLastPlaces = threeLastPlaces
        },

        storeImages(images){
            this.images = images
        },

        storeNewLieu(newLieu){
            this.lieux.push(newLieu)
        }
    },

    persist: true, // activation du plugin de persistance
})