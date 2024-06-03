import { DataProvider, fetchUtils } from "react-admin";

const API_URL = "http://localhost/api";

export const dataProvider: DataProvider = {
  getList: async (resource, params) => {
    const { page, perPage } = params.pagination;
    const { field, order } = params.sort;
    const response = await fetchUtils.fetchJson(
      `${API_URL}/${resource}?_page=${page}&_limit=${perPage}&_sort=${field}&_order=${order}`
    );

    return {
      data: response.json.data,
      total: response.json.total
    }
  }, 

  getOne(resource, params) {
    return fetchUtils.fetchJson(`${API_URL}/${resource}/${params.id}`).then(response => ({
      data: response.json
    }));
  },

  getManyReference: async (resource, params) => {
    const { page, perPage } = params.pagination;
    const { field, order } = params.sort;
    const response = await fetchUtils.fetchJson(
      `${API_URL}/${resource}?${params.target}=${params.id}&_page=${page}&_limit=${perPage}&_sort=${field}&_order=${order}`
    );

    return {
      data: response.json,
      total: response.json.total
    }
  },

  create: async (resource, params) => {
    const response = await fetchUtils.fetchJson(`${API_URL}/${resource}`, {
      method: "POST",
      body: JSON.stringify(params.data)
    });

    return {
      data: response.json
    }
  },

  update: async (resource, params) => {
    const response = await fetchUtils.fetchJson(`${API_URL}/${resource}/${params.id}`, {
      method: "PUT",
      body: JSON.stringify(params.data)
    });

    return {
      data: response.json
    }
  },

  delete: async (resource, params) => {
    await fetchUtils.fetchJson(`${API_URL}/${resource}/${params.id}`, {
      method: "DELETE"
    });

    return {
      data: params.previousData
    }
  }
}
