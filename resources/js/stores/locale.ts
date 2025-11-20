import { defineStore } from 'pinia'

export const useLocaleStore = defineStore('locale', {
  state: () => ({
    locale: document.documentElement.lang || 'fr'
  }),
  actions: {
    setLocale(newLocale: string) {
      this.locale = newLocale
      document.cookie = `locale=${newLocale};path=/;SameSite=Lax`
      document.documentElement.lang = newLocale
      window.dispatchEvent(new CustomEvent('locale-changed', { detail: { locale: newLocale } }))
    },
  }
})
