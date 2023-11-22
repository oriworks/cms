import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nova-permissions', IndexField)
  app.component('detail-nova-permissions', DetailField)
  app.component('form-nova-permissions', FormField)
})
