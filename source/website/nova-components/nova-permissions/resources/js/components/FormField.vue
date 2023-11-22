<template>
    <DefaultField
      :field="field"
      :errors="errors"
      :show-help-text="showHelpText"
      :full-width-content="fullWidthContent"
    >
      <template #field>
        <div class="w-full grid gap-4">
          <div v-for="(permissions, group) in field.options" :key="group" class="flex flex-col gap-2">
            <h1 class="font-bold text-md capitalize flex gap-1 items-center">
              <checkbox :checked="isGroupChecked(group)" @click="toggleGroup(group)"/>
              <label class="w-full ml-1" @click="toggleGroup(group)">
                {{ __(group) }}
              </label>
            </h1>
            <div class="grid grid-cols-4 gap-4 break-words">
              <div v-for="(permission, option) in permissions" :key="permission.option">
                <checkbox
                  :value="permission.value"
                  :checked="isChecked(permission.value)"
                  @input="toggleOption(permission.value)"
                />
                <label
                  :for="field.name"
                  v-text="permission.label"
                  @click="toggleOption(permission.value)"
                  class="w-full ml-1"
                ></label>
                </div>
            </div>
          </div>
        </div>
      </template>
    </DefaultField>
  </template>

  <script>
  import { FormField, HandlesValidationErrors } from 'laravel-nova';

  export default {
    mixins: [
      FormField,
      HandlesValidationErrors
    ],
    props: [
      'resourceName',
      'resourceId',
      'field'
    ],
    data: {},
    methods: {
      availableOptions(group) {
        return this.field.options[group];
      },

      checkAll(group) {
        this.availableOptions(group).forEach(
          (permission) => this.check(permission.value)
        );
      },

      uncheckAll(group) {
        this.availableOptions(group).forEach(
          (permission) => this.uncheck(permission.value)
        );
      },

      isChecked(option) {
        return this.value && this.value.includes(option);
      },

      isGroupChecked(group) {
        return !this.availableOptions(group).some(permission => !this.isChecked(permission.value));
      },

      check(option) {
        if (!this.isChecked(option)) {
          this.value.push(option);
        }
      },

      uncheck(option) {
        if (this.isChecked(option)) {
          this.value = this.value.filter(item => item != option);
        }
      },

      toggleGroup(group) {
        this.isGroupChecked(group) ? this.uncheckAll(group) : this.checkAll(group);
      },

      toggleOption(option) {
        this.isChecked(option) ? this.uncheck(option) : this.check(option);
      },

      setInitialValue() {
        this.value = this.field.value || [];
      },

      fill(formData) {
        formData.append(this.field.attribute, this.value || []);
      },

      handleChange(value) {
        this.value = value;
      }
    }
  };
  </script>
