<template>
    <PanelItem :field="field">
      <template #value>
        <div class="grid gap-4">
          <div v-for="(permissions, group) in field.options" :key="group" class="flex flex-col gap-2">
            <h1 class='font-bold text-md capitalize'>
              {{ group }}
            </h1>
            <div class="grid grid-cols-4 gap-2">
              <div v-for="(permission, option) in permissions" :key="permission.value" class="flex gap-1 items-center">
                <Icon
                  viewBox="0 0 24 24"
                  width="16"
                  height="16"
                  :type="hasPermission(permission.value) ? 'check-circle' : 'x-circle'"
                  :class="hasPermission(permission.value) ? 'text-green-500' : 'text-red-500'"
                />
                <span>{{ permission.label }}</span>
              </div>
            </div>
          </div>
        </div>
      </template>
    </PanelItem>
  </template>

  <script>
  export default {
    props: [
      'resource',
      'resourceName',
      'resourceId',
      'field'
    ],
    methods: {
      hasPermission(value) {
        return this.field.value && this.field.value.includes(value)
      }
    },
  }
  </script>
