const BannerHome = () => {
    return ( 
        <>
        <div className="min-h-screen flex flex-col">
        

        {/* Banner */}
        <section className="bg-gradient-to-r from-slate-900 via-sky-800 to-slate-900 text-white py-20 text-center shadow-md">
          <div className="max-w-4xl mx-auto px-6">
            <h1 className="text-4xl md:text-5xl font-extrabold mb-4">
              Bem-vindo ao Meu Site
            </h1>
            <p className="text-lg md:text-xl font-light">
              Ah sei lá , Projeto do Glauco
            </p>
          </div>
        </section>
        </div>
        </>
     );
}
 
export default BannerHome;