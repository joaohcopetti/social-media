export type TableHeader = {
    label: string
    prop: string
    width?: string
    centered?: boolean
}

export type DropdownItem = {
    label: string
    icon?: string
    href?: string
    openInNewTab?: boolean
    onClick?: () => void
}

export type ProfileTab = {
    label: string
    slot: string
    icon?: string
    href: string
}

export type ProfileForm = {
    name: string
    description?: string
    photo: File | null
    is_user: boolean
    stripe_price_id: string
    email?: string
    password?: string
    password_confirmation?: string
    facebook: string
    instagram: string
    x_twitter: string
    tiktok: string
    youtube: string
    _method: 'POST' | 'PATCH'
}

export type Media = {
    id?: number
    uniqueId: string
    size: number
    base64?: string | ArrayBuffer | null
    url?: string
    file: File | null
    thumbnailFile: File | null
    isFree: boolean
    showOnHome: boolean
    progress?: number
    index: number
    type: string
}

export type UserForm = {
    name: string
    email: string
    password: string
    password_confirmation: string
}
