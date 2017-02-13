using Owin;
using Swagg.Api.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Hangfire;

namespace Swagg.Api
{
    public partial class Startup
    {
        public void ConfigureHangfire(IAppBuilder app)
        {
            using(var db = new ApplicationDbContext())
            {
                GlobalConfiguration.Configuration.UseSqlServerStorage(db.Database.Connection.ConnectionString);
            }
            app.UseHangfireDashboard();
            app.UseHangfireServer();
        }
    }
}