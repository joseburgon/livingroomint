import nightwind from "nightwind/helper"

function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
        !!window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
    )
}

function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
}

export default () => ({
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
        this.dark = !this.dark
        nightwind.enable(this.dark)
        setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
        this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
        this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
        this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
        this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
        this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
        this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
})

