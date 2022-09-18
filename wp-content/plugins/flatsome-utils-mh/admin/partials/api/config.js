import { affApi, jsonToFormData } from './index.js'

export function setConfigs(data) {
  return affApi.post('', jsonToFormData({ action: 'fsut_set_configs', data }))
}


export function getConfigs(data) {
  return affApi.post('', jsonToFormData({ action: 'fsut_get_configs', data }))
}

