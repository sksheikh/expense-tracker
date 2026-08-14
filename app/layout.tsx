import type { Metadata } from 'next'
export const metadata: Metadata = { title: 'Ledgerly — Personal finance', description: 'A clear view of your money.' }
export default function RootLayout({children}:{children:React.ReactNode}) { return <html lang="en" className="bg-[#f7f7fb]"><body>{children}</body></html> }
