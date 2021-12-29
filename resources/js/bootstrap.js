import Alpine from 'alpinejs'
import initData from './init-alpine'
import BrowserDetector from 'browser-dtector'

window.Alpine = Alpine

Alpine.data('initData', initData)

Alpine.start()

window.BrowserDetector = new BrowserDetector(window.navigator.userAgent)
