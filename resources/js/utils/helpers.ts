import { omit } from 'lodash-es'

type PaginationLink = {
    url?: string
    label: string
    active: boolean
}

export type Pagination = {
    links: PaginationLink[]
    nextPageUrl?: string
    previousPageUrl?: string
    total: number
    currentPage: number
    lastPage: number
}

export const formatPaginationFromData = (dataWithPagination: any): Pagination => {
    const paginationData = omit(dataWithPagination, 'data')

    return {
        links: paginationData.links,
        nextPageUrl: paginationData.next_page_url,
        previousPageUrl: paginationData.previous_page_url,
        total: paginationData.total,
        currentPage: paginationData.current_page,
        lastPage: paginationData.last_page,
    }
}

export const inputFileToBase64 = (file: File): Promise<string | ArrayBuffer | null> =>
    new Promise((resolve, reject) => {
        const reader = new FileReader()
        reader.readAsDataURL(file)

        reader.onload = () => resolve(reader.result)
        reader.onerror = (error) => reject(error)
    })
