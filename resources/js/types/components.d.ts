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
