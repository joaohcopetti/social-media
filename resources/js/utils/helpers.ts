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

export const inputImageToBase64 = (file: File): Promise<string | ArrayBuffer | null> =>
    new Promise((resolve, reject) => {
        const reader = new FileReader()
        reader.readAsDataURL(file)

        reader.onload = () => resolve(reader.result)
        reader.onerror = (error) => reject(error)
    })

export const inputVideoToBase64 = (file: File): Promise<string> => {
    return new Promise((resolve) => {
        const canvas = document.createElement('canvas')
        const video = document.createElement('video')

        video.autoplay = true
        video.muted = true
        video.src = URL.createObjectURL(file)

        video.onloadeddata = () => {
            const ctx = canvas.getContext('2d')
            if (!ctx) {
                return
            }

            canvas.width = video.videoWidth
            canvas.height = video.videoHeight

            ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight)
            video.pause()

            return resolve(canvas.toDataURL('image/png'))
        }
    })
}
